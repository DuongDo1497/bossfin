@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="event-details-wrapper">
                        <div class="event-details-thumb">
                            <img src="{{ getImage(getFilePath('campaign') . '/' . $campaign->image, getFileSize('campaign')) }}"
                                alt="@lang('image')">
                        </div>
                    </div>
                    <div class="event-details-area mt-50">
                        <ul class="nav nav-tabs nav-tabs--style" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="description-tab" data-bs-toggle="tab" href="#description"
                                    role="tab" aria-controls="description" aria-selected="true">@lang('Description')</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="gallery-tab" data-bs-toggle="tab" href="#gallery" role="tab"
                                    aria-controls="gallery" aria-selected="false">@lang('Proof Image')</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="video-tab" data-bs-toggle="tab" href="#pdf" role="tab"
                                    aria-controls="pdf" aria-selected="false">@lang('Proof Document')</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="review-tab" data-bs-toggle="tab" href="#review" role="tab"
                                    aria-controls="review" aria-selected="false">@lang('Comment')</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-4" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel"
                                aria-labelledby="description-tab">
                                <p class="text-justify"> @php echo $campaign->description @endphp</p>
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
                            <div class="tab-pane fade" id="pdf" role="tabpanel" aria-labelledby="pdf-tab">
                                @foreach ($campaign->proof_images as $pdfFiles)
                                    @if (explode('.', $pdfFiles)[1] == 'pdf')
                                        <iframe class="iframe" src="{{ asset(getFilePath('proof') . '/' . $pdfFiles) }}" frameborder="0"
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
                                                <h6 class="name mb-1">{{ __($comment->fullname) }}</h6>
                                                <span class="date">{{ diffforhumans($comment->created_at) }}</span>
                                                <p class="mt-2 text-justify">{{ __($comment->comment) }}</p>
                                            </div>
                                        </li>
                                    @empty
                                        <p class="text-center border py-3">@lang('No review yet!')</p>
                                    @endforelse
                                </ul>
                            </div><!-- tab-pane end -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-lg-0">
                    <div class="donation-sidebar custom--shadow">
                        <div class="donation-widget">
                            <h3>{{ strLimit($campaign->title, 20) }}</h3>
                            <p> @php  echo strLimit(strip_tags($campaign->description), 120); @endphp </p>
                            <hr>
                            <div class="row mt-2 justify-content-between">
                                <div class="col-sm-6 text-center">
                                    <b>{{ $general->cur_sym }}{{ showAmount($campaign->donation->where('status', Status::DONATION_PAID)->sum('donation')) }}</b>
                                    <br> @lang('Donated')
                                </div>
                                <div class="col-sm-6 text-center">
                                    @lang('Goal Amount') <br> <b>{{ $general->cur_sym }}{{ showAmount($campaign->goal) }}</b>
                                </div>
                            </div>
                            <div class="row mt-50 mb-none-30">
                                <div class="col-6 donate-item text-center mb-30">
                                    <h4 class="amount">{{ $campaign->donation->where('status', Status::DONATION_PAID)->count() }}
                                    </h4>
                                    <p>@lang('Donors')</p>
                                </div>
                                <div class="col-6 donate-item text-center mb-30">
                                    <h4 class="amount">
                                        {{ $general->cur_sym }}{{ showAmount($campaign->donation->where('status', Status::DONATION_PAID)->sum('donation')) }}
                                    </h4>
                                    <p>@lang('Donated')</p>
                                </div>
                            </div>
                        </div><!-- donation-widget end -->

                        <div class="donation-widget">
                            <h3>@lang('Event Share')</h3>
                            <div class="link-copy copy mt-3">
                                    <input type="text" id="urlCopyId"
                                        value="{{ route('campaign.details', ['slug' => $campaign->slug, 'id' => $campaign->id]) }}"
                                        class="form-control">
                                    <button type="button" class="copyText">@lang('Copy')</button>
                            </div>
                            <ul class="social-links mt-4">
                                <li class="facebook"><a target="_blank"
                                        href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"><i
                                            class="fab fa-facebook-f"></i></a></li>
                                <li class="twitter"><a target="_blank"
                                        href="https://twitter.com/intent/tweet?text=Post and Share &amp;url={{ urlencode(url()->current()) }}"><i
                                            class="fab fa-twitter"></i></a></li>
                                <li class="linkedin"><a target="_blank"
                                        href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ urlencode(url()->current()) }}"><i
                                            class="fab fa-linkedin-in"></i></a></li>
                                <li class="whatsapp"> <a
                                        href="https://api.whatsapp.com/send?text={{ urlencode(url()->current()) }}"><i
                                            class="fab fa-whatsapp"></i></a></li>
                            </ul>
                        </div><!-- donation-widget end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- event details section end -->
@endsection

@push('style')
    <style>
        .iframe {
            width: 100%;
            height: 800px;
        }
    </style>
@endpush

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
    </script>
@endpush

