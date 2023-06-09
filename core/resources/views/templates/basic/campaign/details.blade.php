@php
    $donor    = $campaign->donation->where('status', Status::DONATION_PAID);
    $donation = $donor->sum('donation');
    $percent  = percent($donation,$campaign);
@endphp

@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <!-- event details section start -->
    <section class="pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="event-details-wrapper">
                        <div class="event-details-thumb">
                            <img src="{{ getImage(getFilePath('campaign') . '/' . $campaign->image, getFileSize('campaign')) }}"
                                alt="@lang('image')">
                        </div>
                    </div><!-- event-details-wrapper end -->
                    <div class="event-details-area mt-50">
                        <ul class="nav nav-tabs nav-tabs--style" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                    data-bs-target="#description" href="#description" role="tab"
                                    aria-controls="description" aria-selected="true">@lang('Description')</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="gallery-tab" data-bs-toggle="tab" data-bs-target="#gallery"
                                    href="#gallery" role="tab" aria-controls="gallery"
                                    aria-selected="false">@lang('Relevent Image')</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="video-tab" data-bs-toggle="tab" data-bs-target="#document"
                                    href="#video" role="tab" aria-controls="document"
                                    aria-selected="false">@lang('Relevent Document')</a>
                            </li>

                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review"
                                    href="#review" role="tab" aria-controls="review"
                                    aria-selected="false">@lang('Comments')</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-4" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel"
                                aria-labelledby="description-tab">
                                <p class="text-justify">@php echo $campaign->description @endphp</p>
                            </div><!-- tab-pane end -->
                            <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
                                <div class="row gy-4">
                                    @foreach ($campaign->proof_images as $images)
                                        @if (explode('.', $images)[1] != 'pdf')
                                            <div class="col-lg-4 col-sm-6 mb-30">
                                                <div class="gallery-card">
                                                    <a href="{{ asset(getFilePath('proof') . '/' . $images) }}"
                                                        class="view-btn" data-rel="lightcase:myCollection"><i
                                                            class="las la-plus"></i></a>
                                                    <div class="gallery-card__thumb">
                                                        <img src="{{ asset(getFilePath('proof') . '/' . $images) }}"
                                                            alt="@lang('image')">
                                                    </div>
                                                </div><!-- gallery-card end -->
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div><!-- tab-pane end -->
                            <div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby="document-tab">
                                @foreach ($campaign->proof_images as $pdfFiles)
                                    @if (explode('.', $pdfFiles)[1] == 'pdf')
                                        <iframe width="100%" height="800"
                                            src="{{ asset(getFilePath('proof') . '/' . $pdfFiles) }}" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                    @endif
                                @endforeach
                            </div><!-- tab-pane end -->

                            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                <ul class="review-list mb-50">
                                    @forelse($campaign->comments->where('status',Status::PUBLISHED) as $comment)
                                        <li class="single-review">
                                            <div class="thumb"><i class="fa fa-user comment-user"></i></div>
                                            <div class="content">
                                                <h6 class="name">{{ __($comment->fullname) }}</h6>
                                                <small class="date">{{ diffforhumans($comment->updated_at) }}</small>

                                                <p class="mt-1 text-justify">{{ __($comment->comment) }}</p>
                                            </div>
                                        </li>
                                    @empty
                                        <p class="text-center border py-3">@lang('No Comment Yet')</p>
                                    @endforelse
                                </ul>
                                <form action="{{ route('campaign.comment') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="campaign" value="{{ $campaign->id }}">
                                        <div class="form-group col-lg-6">
                                            <input type="text" name="fullname" placeholder="@lang('Enter Name')"
                                                class="form-control" required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <input type="email" name="email" placeholder="@lang('Enter Email Address')"
                                                class="form-control" required>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <textarea placeholder="@lang('Enter Your Comment')" class="form-control" name="comment"></textarea>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="cmn-btn w-45">@lang('SUBMIT COMMENT')</button>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- tab-pane end -->

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-lg-0 mt-5">
                    <div class="donation-sidebar">
                        <div class="donation-widget">
                            <pg class="title">{{ $campaign->title }}</pg>
                            <div class="skill-bar mt-5">
                                <div class="progressbar" data-perc="{{ $percent > 100 ? '100' : $percent }}%">
                                    <div class="bar"></div>
                                    <span class="label">{{ showAmount($percent > 100 ? '100' : $percent) }}%</span>
                                </div>
                            </div>
                            <div class="row mt-2 justify-content-between">
                                <div class="col-sm-6">
                                    @lang('Donated') <br>
                                    <b>{{ $general->cur_sym }}{{ showAmount($donation) }}</b>

                                </div>
                                <div class="col-sm-6">
                                    @lang('Goal Amount') <br>
                                    <b>{{ $general->cur_sym }}{{ showAmount($campaign->goal) }}</b>
                                </div>
                            </div>
                            <div class="row mt-50 mb-none-30">
                                <div class="col-6 donate-item mb-30">
                                    <h4 class="amount">{{ $donor->count() }}</h4>
                                    <p>@lang('Donors')</p>
                                </div>
                                <div class="col-6 donate-item mb-30">
                                    <h4 class="amount"> {{ $general->cur_sym }}{{ showAmount($donation) }}</h4>
                                    <p>@lang('Donated')</p>
                                </div>
                            </div>
                        </div><!-- donation-widget end -->
                        <div class="donation-widget">
                            <form class="vent-details-form" method="POST"
                                action="{{ route('campaign.donation.process', [$campaign->slug, $campaign->id]) }}">
                                @csrf
                                <h3 class="mb-3">@lang('Donate Amount')</h3>
                                <div class="form-row align-items-center">
                                    <div class="col-lg-12 form-group donate-amount">
                                        <div class="input-group mr-sm-2">
                                            <div class="input-group-text">{{ $general->cur_sym }}</div>
                                            <input type="number" id="donateAmount" class="form-control" value="0"
                                                name="amount" required>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group donated-amount">
                                        <div class="form--radio form-check-inline">
                                            <input class="form-check-input donation-radio-check" type="radio"
                                                name="customRadioInline1" value="100" id="customRadioInline1">
                                            <label class="form-check-label" for="customRadioInline1">
                                                {{ $general->cur_sym }}@lang('100')
                                            </label>
                                        </div>
                                        <div class="form--radio form-check-inline">
                                            <input class="form-check-input donation-radio-check" type="radio"
                                                name="customRadioInline1" value="200" id="customRadioInline2">
                                            <label class="form-check-label" for="customRadioInline2">
                                                {{ $general->cur_sym }}@lang('200')
                                            </label>
                                        </div>
                                        <div class="form--radio form-check-inline">
                                            <input class="form-check-input donation-radio-check" type="radio"
                                                name="customRadioInline1" value="300" id="customRadioInline3">
                                            <label class="form-check-label" for="customRadioInline3">
                                                {{ $general->cur_sym }}@lang('300')
                                            </label>
                                        </div>
                                        <div class="form--radio form-check-inline">
                                            <input class="form-check-input donation-radio-check custom-donation"
                                                type="radio" name="customRadioInline1" id="flexRadioDefault4">
                                            <label class="form-check-label" for="flexRadioDefault4">
                                                @lang('Custom')
                                            </label>
                                        </div>
                                    </div>

                                </div>
                                <h3 class="mb-4 mt-30">@lang('Personal Information')</h3>

                                @if ($general->anonymous_donation)
                                    <div class="form--check mb-4">
                                        <input class="form-check-input" type="checkbox" name="anonymous" id="checkdon"
                                            value="1">
                                        <label class="form-check-label" for="checkdon">
                                            @lang('Make Anonymous Donation')
                                        </label>
                                    </div>
                                @endif


                                @php
                                    $user=auth()->user();
                                @endphp
                                <div class="form-row">
                                    <div class="form-group col-lg-12">
                                        <label>@lang('Full Name')</label>
                                        <input type="text" name="name" value="{{old('name',@$user->fullname)}}" class="form-control checktoggle" required>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label>@lang('Email')</label>
                                        <input type="text" name="email" value="{{ old('email',@$user->email)}}" class="form-control checktoggle" required>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label>@lang('Mobile'): </label>
                                        <input type="number" name="mobile" value="{{ old('mobile',@$user->mobile)}}" class="form-control checktoggle" required>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label>@lang('Country')</label>
                                        <input type="text" name="country" value="{{ old('country',@$user->address->country)}}" class="form-control checktoggle"required>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="hidden" name="campaign_id" value="{{ $campaign->id}}">
                                        <button type="submit" class="cmn-btn w-100" @if (@auth()->user()->id == $campaign->user_id) disabled @endif>@lang('DONATE NOW')</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="donation-widget">
                            <h3>@lang('Event Share')</h3>
                            <div class="link-copy copy mt-3">
                                    <input type="text" id="urlCopyId"
                                        value="{{ route('campaign.details', ['slug' => $campaign->slug, 'id' => $campaign->id]) }}"
                                        class="form-control">
                                    <button type="button" class="copyText">@lang('COPY')</button>
                            </div>
                            <ul class="social-links mt-4">
                                <li class="facebook face"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="twitter twi"><a target="_blank"
                                        href="https://twitter.com/intent/tweet?text=Post and Share &amp;url={{ urlencode(url()->current()) }}"><i
                                            class="fab fa-twitter"></i></a></li>
                                <li class="linkedin lin"><a target="_blank"
                                        href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ urlencode(url()->current()) }}"><i
                                            class="fab fa-linkedin-in"></i></a></li>
                                <li class="whatsapp what"><a target="_blank"
                                        href="https://wa.me/?text={{ urlencode(url()->current()) }}"><i
                                            class="fab fa-whatsapp"></i></a></li>
                            </ul>
                        </div><!-- donation-widget end -->

                        <div class="donation-widget pb-5">
                            <h3 class="mb-4">@lang('Latest Donation')</h3>
                            <ul class="donor-small-list">

                                @php
                                    $allDonors = $donor;
                                @endphp
                                @forelse($allDonors->take(4) as $donor)
                                    <li class="single">
                                        <div class="thumb feature-card__icon "><i class="fa fa-user"></i></div>
                                        <div class="content">
                                            <h6>{{ $donor->fullname }}</h6>
                                            <p>@lang('Amount') :
                                                {{ $general->cur_sym }}{{ showAmount($donor->donation) }}</p>
                                        </div>
                                    </li>
                                @empty
                                    {{ __($emptyMessage) }}
                                @endforelse

                                @if ($allDonors->count() > 4)
                                    <li class="single">
                                        <button type="button"
                                            class="donarModal cmn-btn w-100">@lang('See All Donors')</button>
                                    </li>
                                @endif
                            </ul>
                        </div><!-- donation-widget end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- event details section end -->

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('All Donors')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="donation-widget pb-5">
                        <ul class="donor-small-list">
                            @foreach ($allDonors as $donor)
                                <li class="single">
                                    <div class="thumb feature-card__icon "><i class="fa fa-user"></i></div>
                                    <div class="content">
                                        <h6>{{ $donor->fullname }}</h6>
                                        <p>@lang('Amount') :
                                            {{ $general->cur_sym }}{{ showAmount($donor->donation) }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        'use strict';

        //copy-url
        $('.copyText').on('click', function() {
            var copyText = document.getElementById("urlCopyId");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            notify('success', 'URL copied successfully');
        })

        $('#checkdon').on('change', function() {
            var status = this.checked;
            if (status) {
                $('.checktoggle').prop("disabled", true)
                $('input[name=name]').val('');
                $('input[name=email]').val('');
                $('input[name=mobile]').val('');
                $('input[name=country]').val('');
            } else {
                @if($user)
                    let user=@json($user);
                    $('input[name=name]').val(user.firstname+' '+user.lastname);
                    $('input[name=email]').val(user.email);
                    $('input[name=mobile]').val(user.mobile);
                    $('input[name=country]').val(user.address.country);
                @endif
                $('.checktoggle').prop("disabled", false)
            }
        })


        $(".progressbar").each(function() {
            $(this).find(".bar").animate({
                "width": $(this).attr("data-perc")
            }, 3000);
            $(this).find(".label").animate({
                "left": $(this).attr("data-perc")
            }, 3000);
        });

        //donation-checkbox
        $(".donation-radio-check").on('click', function(e) {
            $(".donation-radio-check").attr('checked', false);
            $(this).prop('checked', true);
            $("[name=amount]").val($(this).val())
        });

        $("#donateAmount").on('click', function(e) {
            $(".donation-radio-check").prop('checked', false);
            $(".custom-donation").prop('checked', true);
            $(this).val("");
        });

        $(".custom-donation").on('click', function(e) {
            $("[name=amount]").focus();
            $("[name=amount]").val();
        });

        //donor list
        $('.donarModal').click(function() {
            $('#modelId').modal('show')
        })


    </script>
@endpush
