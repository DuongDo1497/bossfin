<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Donation;
use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CampaignController extends Controller
{

    public function index()
    {
        $pageTitle = 'Campaigns';
        $sections  = Page::where('tempname', $this->activeTemplate)->where('slug', 'campaign')->first();
        $campaigns = Campaign::running()->with(['donation' => function ($q) {
            $q->where('status', Status::DONATION_PAID);
        }, 'category'])->orderBy('id', 'DESC')->filters(request('category'));
        if (request()->slug) {
            $category  = Category::where('slug', request()->slug)->active()->firstOrFail();
            $campaigns = $campaigns->where('category_id', $category->id);
        }
        $campaigns  = $campaigns->paginate(getPaginate());
        $categories = Category::active()->hasCampaigns()->orderBy('id', 'DESC')->get();
        return view($this->activeTemplate . 'campaign.index', compact('pageTitle', 'campaigns', 'categories','sections'));
    }

    public function filterCampaign(Request $request)
    {
        $type  = '';
        $query = Campaign::active()->running()->inComplete()->with('donation');

        if ($request->search) {
            $query =   $query->whereDate('deadline', '>', now())->searchable(['title']);
        }

        if ($request->category_id) {
            $query = $query->where('category_id', $request->category_id);
            $type  = Category::where('id', $request->category_id)->first()->name;
        }

        if ($request->checkbox == 'urgent') {
            $query =   $query->whereDate('deadline', '>', now())
                ->whereDate('deadline', '<=', Carbon::now()->addDays(5));
            $type = 'Urgent';
        } else if ($request->checkbox == 'feature') {
            $query = $query->where('featured', Status::YES)->whereDate('deadline', '>', now());
            $type  = 'Feature';
        } else if ($request->checkbox == 'top') {
            $campaigns = Donation::paid()->groupBy('campaign_id')->with('campaign.donation')->whereHas('campaign', function ($campaign) {
                $campaign->active()->running()->inComplete()
                    ->whereDate('deadline', '>', now())
                    ->filters(request('category'));
            })->selectRaw('*,sum(donation) as donate')->orderBy('donate', 'DESC')->take(12)->get()->map(function ($campaign) {
                return $campaign->campaign;
            });
            $type = 'Top';
            return view($this->activeTemplate . 'partials.campaign', compact('campaigns', 'type'));
        }

        if ($request->date) {
            $query =  $query->whereDate('created_at', '>=', $request->date);
        }
        $campaigns =  $query->orderBy('id', 'DESC')->get();
        return view($this->activeTemplate . 'partials.campaign', compact('campaigns', 'type'));
    }

    public function details(Request $request)
    {
        $pageTitle = "Campaign Details";
        $campaign = Campaign::where('slug', $request->slug)->findOrFail($request->id);

        $seoContents['keywords']           = $campaign->meta_keywords ?? [];
        $seoContents['social_title']       = $campaign->title;
        $seoContents['description']        = strLimit(strip_tags($campaign->description), 150);
        $seoContents['social_description'] = strLimit(strip_tags($campaign->description), 150);

        $seoContents['image']              = getImage(getFilePath('campaign') . '/' . $campaign->image, '750x550');
        $seoContents['image_size']         = '750x550';


        return view($this->activeTemplate . 'campaign.details', compact('pageTitle', 'campaign', 'seoContents'));
    }

    public function comment(Request $request)
    {

        $request->validate([
            'campaign' => 'required|numeric',
            'fullname' => 'required|min:3|max:40',
            'email'    => 'required|email',
            'comment'  => 'required|min:10|max:2000',
        ]);

        $comment = new Comment();
        $comment->campaign_id = $request->campaign;
        $comment->fullname    = $request->fullname;
        $comment->email       = $request->email;
        $comment->comment     = $request->comment;
        $comment->save();
        $notify[] = ['success', 'Comment saved successfully, Please wait for publish'];
        return back()->withNotify($notify);
    }
}
