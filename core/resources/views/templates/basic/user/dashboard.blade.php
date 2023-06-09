@php
    $kycInstruction = getContent('kyc_instruction.content', true);
@endphp
@extends($activeTemplate . 'layouts.master')
@section('content')
    <!-- dashboard section start -->
    <section class="pt-120 pb-120">
        <div class="container">
            <div class="row gy-4">
                @if ($user->kv == 0)
                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">@lang('KYC Verification required')</h4>
                        <hr>
                        <p class="mb-0">{{ __($kycInstruction->data_values->verification_instruction) }} <a
                                class="text--base" href="{{ route('user.kyc.form') }}">@lang('Click Here to Verify')</a></p>
                    </div>
                @elseif($user->kv == 2)
                    <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading">@lang('KYC Verification pending')</h4>
                        <hr>
                        <p class="mb-0">{{ __($kycInstruction->data_values->pending_instruction) }} <a class="text--base"
                                href="{{ route('user.kyc.data') }}">@lang('See KYC Data')</a></p>
                    </div>
                @endif

                @if ($campaign['expired'] > 0)
                    <div class="offset-lg-8 col-lg-4 col-md-12">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <a class="text-danger" href="{{ route('user.campaign.fundrise.expired') }}" class="text-primary">
                                @lang('Campaign Expired') (<strong>{{ $campaign['expired'] }}</strong>)
                            </a>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-one">
                        <div class="d-widget__icon">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white">{{ $campaign['allCampaign'] }}</h2>
                            <span class="text-white">@lang('Total Campaign')</span>
                        </div>
                        <a href="{{ route('user.campaign.fundrise.all') }}" class="view-btn">@lang('View all')</a>

                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-four">
                        <div class="d-widget__icon">
                            <i class="fas fa-spinner"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white">{{ $campaign['pending'] }}</h2>
                            <span class="text-white">@lang('Pending Campaign')</span>
                        </div>
                        <a href="{{ route('user.campaign.fundrise.pending') }}" class="view-btn">@lang('View all')</a>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-five">
                        <div class="d-widget__icon">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white">{{ $campaign['completed'] }}</h2>
                            <span class="text-white">@lang('Campaign Completed')</span>
                        </div>
                        <a href="{{ route('user.campaign.fundrise.complete') }}" class="view-btn">@lang('View all')</a>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-danger">
                        <div class="d-widget__icon">
                            <i class="fa fa-times"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white">{{ $campaign['rejectLog'] }}</h2>
                            <span class="text-white">@lang('Campaign Rejected')</span>
                        </div>
                        <a href="{{ route('user.campaign.fundrise.rejected') }}" class="view-btn">@lang('View all')</a>
                    </div><!-- d-widget end -->
                </div>

                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-two">
                        <div class="d-widget__icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white">
                                {{ $general->cur_sym }}{{ showAmount($campaign['received_donation']) }}</h2>
                            <span class="text-white">@lang('Total Received Donation')</span>
                        </div>
                        <a href="{{ route('user.campaign.donation.received') }}" class="view-btn">@lang('View all')</a>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-three">
                        <div class="d-widget__icon">
                            <i class="fas fa-donate"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white">{{ $general->cur_sym }}{{ showAmount($campaign['my_donation']) }}</h2>
                            <span class="text-white">@lang('My Donation')</span>
                        </div>
                        <a href="{{ route('user.campaign.donation.my') }}" class="view-btn">@lang('View all')</a>
                    </div>
                </div>




                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-seven">
                        <div class="d-widget__icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white">
                                {{ $general->cur_sym }}{{ showAmount($campaign['withdraw']) }}</h2>
                            <span class="text-white">@lang('Total Withdraw')</span>
                        </div>
                        <a href="{{ route('user.withdraw.history') }}" class="view-btn">@lang('View all')</a>
                    </div><!-- d-widget end -->
                </div>

                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-primary">
                        <div class="d-widget__icon">
                            <i class="las la-dollar-sign"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white">
                                {{ $general->cur_sym }}{{ showAmount($campaign['currentBalance']) }}</h2>
                            <span class="text-white">@lang('Current Balance')</span>
                        </div>

                    </div><!-- d-widget end -->
                </div>

                <div class="col-md-6 mb-30">
                    <div class="card custom--shadow">
                        <div class="card-body">
                            <h5 class="card-title">@lang('Monthly Donation Report')</h5>
                            <div id="apex-line"> </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-30">
                    <div class="card custom--shadow">
                        <div class="card-body">
                            <h5 class="card-title">@lang('Monthly Withdraw Report')</h5>
                            <div id="apex-line-withdraw"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- dashboard section end -->
@endsection

@push('script')
    <script src="{{ asset($activeTemplateTrue . 'js/apexchart.js') }}" charset="utf-8"></script>
    <script>
        'use strict';

        //apex-line chart:  Donation
        var options = {
            series: [{
                data: @json($donations['perDayAmount'])
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '15%',
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: @json($donations['perDay'])
            }
        };

        //apex-line chart: Withdraw
        var withdraw = {
            series: [{
                data: @json($withdraws['perDayAmount'])
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '10%',
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: @json($withdraws['perDay'])
            }
        };

        var chart = new ApexCharts(document.querySelector("#apex-line"), options);
        var chart2 = new ApexCharts(document.querySelector("#apex-line-withdraw"), withdraw);

        chart.render();
        chart2.render();
    </script>
@endpush
