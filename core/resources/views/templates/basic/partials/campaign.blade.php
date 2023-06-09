@forelse ($campaigns as $campaign)
    <div class="col-lg-4 col-md-6">
        <div class="event-card hover--effect-1 has-link">
            <div class="feature">
                @if (isset($type))
                    {{ __($type) }}
                @else
                    {{ $campaign->category->name }}
                @endif
            </div>
            <a href="{{ route('campaign.details', ['slug' => $campaign->slug, 'id' => $campaign->id]) }}"
                class="item-link"></a>

            <div class="event-card__thumb">
                <img src="{{ getImage(getFilePath('campaign') . '/' . $campaign->image, getFileSize('campaign')) }}"
                    alt="image" class="w-100">
                @if (@auth()->user()->id == @$campaign->user_id)
                    <span class="event-card__auth">
                        <i class="las la-user-tie"></i>
                    </span>
                @endif
            </div>

            <div class="event-card__content">
                <small><i class="las la-calendar"></i>
                    {{ showDateTime($campaign->created_at, 'Y-m-d') }}</small>
                <h4 class="title pt-2">{{ __(StrLimit($campaign->title, 45)) }}</h4>
                <span class="days-left fst-italic py-3" data-deadline={{ $campaign->deadline }}>
                    <span class="day"></span>
                    <span class="hour"></span>
                    <span class="minute"></span>
                    <span class="sec"></span>
                </span>
                <p class="text-dark">
                    {{strLimit(strip_tags($campaign->description), 115) }}
                </p>
                <div class="event-bar-item">
                    <div class="skill-bar">
                        @php
                            $campDonation = $campaign->donation->sum('donation');
                            $percent   = percent($campDonation,$campaign);
                        @endphp
                        <div class="progressbar" data-perc="{{ progressPercent($percent) }}%">
                            <div class="bar"></div>
                            <span class="label">{{ showAmount(progressPercent($percent), 2) }}%</span>
                        </div>
                    </div>
                </div><!-- event-bar-item end -->
                <div class="amount-status">
                    <div class="left">
                        @lang('Goal ')&nbsp;
                       <b>{{ $general->cur_sym }}{{ showAmount($campaign->goal) }}</b>
                    </div>
                    <div class="right">
                        @lang('Raised')&nbsp;
                       <b>{{ $general->cur_sym }}{{ showAmount($campDonation) }}</b>
                    </div>
                </div>
            </div>
        </div><!-- event-card end -->
    </div>
@empty
    <div class="mx-auto d-flex justify-content-center">
        <div class="card custom--shadow">
            <div class="card-header text-center">
                <h5 class="px-5">@lang('Opps! No Campaign Found')</h5>
            </div>
            <div class="card-body text-center py-5">
                <a href="{{ url()->previous() }}" class="btn cmn-btn"><i class="las la-undo"></i> @lang('Back')</a>
            </div>
        </div>
    </div>
@endforelse



