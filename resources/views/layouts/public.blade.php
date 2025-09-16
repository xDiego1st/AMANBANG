<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="js" id="dynamic-body">

<head>
    <meta charset="utf-8">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/logo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-small.png') }}">
    <meta name="author" content="DISKOMINFO">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ config('app.name') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Page Title  -->
    <title> {{ $title }} | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- StyleSheets  -->
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css') }}">
    <link rel="stylesheet" href="{{ asset('assets0/css/dashlite.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets0/css/theme.css') }}">

    <link rel="{{ asset('assets/css/libs/fontawesome-icons.css') }}">
    @stack('css')

    <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" /> -->
    <!-- <link href="https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css" rel="stylesheet" /> -->
    <!-- <link rel="stylesheet" href="{{ asset('style-map-leaflet.css') }}" rel="stylesheet"> -->
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/cferdinandi/tabby@12.0.0/dist/css/tabby-ui.min.css" /> --}}
    <script src="https://cdn.jsdelivr.net/gh/cferdinandi/tabby@12.0.0/dist/js/tabby.polyfills.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/tomickigrzegorz/autocomplete@1.8.6/dist/css/autocomplete.min.css" />
    <!-- <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js"></script> -->
    <script src="https://cdn.jsdelivr.net/gh/tomickigrzegorz/autocomplete@1.8.6/dist/js/autocomplete.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/MarkerCluster.css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/MarkerCluster.Default.css" />
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/leaflet.markercluster.js"></script>
    <script src="https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js"></script> -->
</head>

<body class="nk-body npc-covid has-sidebar has-sidebar-short ui-clean ui-rounder">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <div class="nk-sidebar nk-sidebar-short nk-sidebar-fixed is-light" data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="{{ route('Home') }}" class="logo-link nk-sidebar-logo">
                            <img class="logo-light logo-img" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                            <img class="logo-dark logo-img" src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                        </a>
                        <a href="{{ route('Home') }}" class="logo-link nk-sidebar-logo-small">
                            <img class="logo-light logo-img" src="./images/logo-small.png" srcset="./images/logo-small2x.png 2x" alt="logo">
                            <img class="logo-dark logo-img" src="./images/logo-dark-small.png" srcset="./images/logo-dark-small2x.png 2x" alt="logo-dark">
                        </a>
                    </div>
                    <div class="nk-menu-trigger me-n2">
                        <a href="javascript:void(0)" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-body" data-simplebar>
                        <div class="nk-sidebar-content">
                            <div class="nk-sidebar-menu nk-sidebar-menu-middle">
                                <!-- Menu -->
                                <ul class="nk-menu short-menu">
                                    <li class="nk-menu-item">
                                        <a href="{{ route('Home') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-notify"></em></span>
                                            <span class="nk-menu-text">Beranda</span>
                                            <span class="nk-menu-tooltip" title="Beranda"></span>
                                        </a>
                                    </li>
                                </ul><!-- .nk-menu -->
                            </div><!-- .nk-sidebar-menu -->
                            <div class="nk-sidebar-footer d-none d-md-block">
                                <ul class="nk-menu short-menu">
                                    <li class="nk-menu-item">
                                        <a href="{{ route('dashboard') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-shield-alert-fill text-danger"></em></span>
                                            <span class="nk-menu-text">Dashboard</span>
                                            <span class="nk-menu-tooltip" title="Akses Dashboard Admin">
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a data-bs-toggle="modal" href="#covid-about" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-info-fill text-info"></em></span>
                                            <span class="nk-menu-text">About Data</span>
                                            <span class="nk-menu-tooltip" title="Informasi Tentang Data">
                                        </a>
                                    </li>
                                </ul><!-- .nk-menu -->
                            </div><!-- .nk-sidebar-footer -->
                        </div><!-- .nk-sidebar-contnet -->
                    </div><!-- .nk-sidebar-body -->
                </div><!-- .nk-sidebar-element -->
            </div>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header nk-header-fluid nk-header-fixed nk-header-onlymobile is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-header-brand">
                                <a href="javascript:void(0)" class="logo-link">
                                    <img class="logo-light logo-img" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                                    <img class="logo-dark logo-img" src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                                </a>
                            </div>
                            <div class="nk-menu-trigger ms-auto me-n1">
                                <a href="javascript:void(0)" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        {{ $slot }}
                    </div>
                </div>
                <!-- content @e -->
                <!-- footer @s -->
                <div class="nk-footer d-md-none">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap gy-1 gx-4">
                            <div class="nk-footer-links">
                                <ul class="nav nav-sm">
                                    <li class="nav-item"><a class="nav-link" href="#covid-feedback" data-bs-toggle="modal">Feedback</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#covid-about" data-bs-toggle="modal">About Data</a></li>
                                </ul>
                            </div>
                            <div class="nk-footer-copyright"> &copy; Copyright 2023, <a href="https://Diskominfo.com" target="_blank">Diskominfo</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- Modal About -->
    <div class="modal fade" tabindex="-1" id="covid-about">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <a href="javascript:void(0)" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-body">
                    <h5 class="mb-3 title">About this data</h5>
                    <h6 class="lead-text text-primary">Cara Pengambilan Data</h6>
                    <p>Data Stunting di update / bulan dengan mengumpulkan terlebih dahulu data balita stunting yang masuk per hari</p>
                    <div class="note-text">Updated: March 27, 2024 12:30 (GMT +7)</div>
                </div>
                <div class="py-1 modal-footer bg-light justify-content-center">
                    <div class="sub-text">Copyright by <a href="https://Diskominfo.com" target="_blank">Diskominfo</a></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Feedback -->
    <div class="modal fade" tabindex="-1" id="covid-feedback">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="justify-between mb-3 gx-5">
                        <div>
                            <h6 class="modal-title text-primary">What kind of feedback do you have about this tool?
                            </h6>
                        </div>
                        <div>
                            <a href="javascript:void(0)" class="btn btn-icon btn-trigger me-n2 mt-n1" data-bs-dismiss="modal" aria-label="Close">
                                <em class="icon ni ni-cross"></em>
                            </a>
                        </div>
                    </div>
                    <ul class="btn-list-vr g-2">
                        <li>
                            <a data-bs-dismiss="modal" data-bs-toggle="modal" href="#covid-feedback-form" class="btn btn-round btn-indc btn-lighter"><em class="icon text-primary ni ni-report"></em> <span>Report an issue</span><em class="indc icon ni ni-chevron-right"></em></a>
                        </li>
                        <li>
                            <a data-bs-dismiss="modal" data-bs-toggle="modal" href="#covid-feedback-form" class="btn btn-round btn-indc btn-lighter"><em class="icon text-primary ni ni-bulb"></em> <span>Share an idea</span><em class="indc icon ni ni-chevron-right"></em></a>
                        </li>
                        <li>
                            <a data-bs-dismiss="modal" data-bs-toggle="modal" href="#covid-feedback-form" class="btn btn-round btn-indc btn-lighter"><em class="icon text-primary ni ni-question-alt"></em> <span>Give a
                                    compliment</span><em class="indc icon ni ni-chevron-right"></em></a>
                        </li>
                        <li>
                            <a data-bs-dismiss="modal" data-bs-toggle="modal" href="#covid-feedback-form" class="btn btn-round btn-indc btn-lighter"><em class="icon text-primary ni ni-policy"></em> <span>Legal or privacy
                                    concern</span><em class="indc icon ni ni-chevron-right"></em></a>
                        </li>
                    </ul>
                </div>
                <div class="py-1 modal-footer bg-light justify-content-center">
                    <div class="sub-text">Copyright by <a href="https://Diskominfo.com" target="_blank">Diskominfo</a></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Feedback Form -->
    <div class="modal fade" tabindex="-1" id="covid-feedback-form">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="justify-between mb-1 gx-5">
                        <div>
                            <h6 class="modal-title text-primary">Tell us about the issue</h6>
                        </div>
                        <div>
                            <a href="javascript:void(0)" class="btn btn-icon btn-trigger me-n2 mt-n1" data-bs-dismiss="modal" aria-label="Close">
                                <em class="icon ni ni-cross"></em>
                            </a>
                        </div>
                    </div>
                    <form action="#">
                        <textarea class="form-control no-resize" placeholder="Enter feedback here. To help protect your privacy, don’t include personal info."></textarea>
                        <div class="justify-between mt-3 align-center">
                            <a href="javascript:void(0)" class="link link-sm">Privacy Policy</a>
                            <ul class="btn-toolbar g-1">
                                <li><a data-bs-dismiss="modal" data-bs-toggle="modal" href="#covid-feedback" class="btn btn-light">Go Back</a></li>
                                <li><a href="javascript:void(0)" class="btn btn-primary">Send</a></li>
                            </ul>
                        </div>
                    </form>
                </div>
                <div class="py-1 modal-footer bg-light justify-content-center">
                    <div class="sub-text">Copyright by <a href="https://Diskominfo.com" target="_blank">Diskominfo</a></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Country Details -->
    <div class="modal fade" tabindex="-1" id="covid-country-details">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="javascript:void(0)" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
                <div class="modal-body">
                    <h5 class="mb-3 modal-title">United States - Coronavirus Cases</h5>
                    <div class="justify-between row g-gs">
                        <div class="col-lg-6">
                            <div class="nk-cov-data">
                                <h6 class="text-base lead-text">Total Confirmed Cases</h6>
                                <div class="amount">138,908</div>
                            </div>
                            <div class="pt-2 row g-2 pt-sm-3">
                                <div class="col-6">
                                    <div class="nk-cov-data">
                                        <h6 class="overline-title-alt fw-normal">Recovered</h6>
                                        <div class="amount amount-xs text-success">4,432 <small>5.1%</small></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="nk-cov-data">
                                        <h6 class="overline-title-alt fw-normal">Deaths</h6>
                                        <div class="amount amount-xs text-danger">2,438 <small>2.59%</small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="nk-cov-data">
                                <h6 class="text-base lead-text">Currently Active Cases</h6>
                                <div class="amount fw-normal">132,038</div>
                            </div>
                            <div class="pt-2 row g-2 pt-sm-3">
                                <div class="col-sm-6">
                                    <div class="nk-cov-data">
                                        <h6 class="overline-title-alt fw-normal">in Mild Condition</h6>
                                        <div class="amount amount-xs text-purple">129,080 <small>5.1%</small></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="nk-cov-data">
                                        <h6 class="overline-title-alt fw-normal">Serious or Critical</h6>
                                        <div class="amount amount-xs text-warning">2,948 <small>2.59%</small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- .row -->
                    <h6 class="mt-4 mb-3 title mt-sm-5">Total Cases & Deaths</h6>
                    <div class="card card-bordered">
                        <ul class="nav nav-tabs nav-tabs-card is-medium">
                            <li class="nav-item"><a href="#totalCase" data-bs-toggle="tab" class="nav-link active">Cases</a></li>
                            <li class="nav-item"><a href="#totalDeaths" data-bs-toggle="tab" class="nav-link">Deaths</a></li>
                            <li class="nav-item"><a href="#totalCompare" data-bs-toggle="tab" class="nav-link">Compare</a></li>
                        </ul>
                        <div class="card-inner">
                            <div class="tab-content">
                                <div class="tab-pane active" id="totalCase">
                                    <h6 class="lead-text">Total Cases in Linear Scale</h6>
                                    <div class="nk-cov-modal-ck">
                                        <canvas class="covid-case-line-chart" id="totalCaseChart"></canvas>
                                    </div>
                                    <div class="justify-between ms-5">
                                        <div class="chart-label small text-soft">22 Jan, 2020</div>
                                        <div class="chart-label small text-soft">28 Mar, 2020</div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="totalDeaths">
                                    <h6 class="lead-text">Total Deaths in Linear Scale</h6>
                                    <div class="nk-cov-modal-ck">
                                        <canvas class="covid-case-line-chart" id="totalDeathsChart"></canvas>
                                    </div>
                                    <div class="justify-between ms-5">
                                        <div class="chart-label small text-soft">22 Jan, 2020</div>
                                        <div class="chart-label small text-soft">28 Mar, 2020</div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="totalCompare">
                                    <h6 class="lead-text">Total Compare in Linear Scale</h6>
                                    <div class="nk-cov-modal-ck">
                                        <canvas class="covid-case-line-chart" id="totalCompareChart"></canvas>
                                    </div>
                                    <div class="justify-between ms-5">
                                        <div class="chart-label small text-soft">22 Jan, 2020</div>
                                        <div class="chart-label small text-soft">28 Mar, 2020</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                    <h6 class="mt-4 mb-3 title mt-sm-5">Daily New Cases & Deaths</h6>
                    <div class="card card-bordered">
                        <ul class="nav nav-tabs nav-tabs-card is-medium">
                            <li class="nav-item"><a href="#dailyCase" data-bs-toggle="tab" class="nav-link active">Cases</a></li>
                            <li class="nav-item"><a href="#dailyDeaths" data-bs-toggle="tab" class="nav-link">Deaths</a></li>
                            <li class="nav-item"><a href="#dailyCompare" data-bs-toggle="tab" class="nav-link">Compare</a></li>
                        </ul>
                        <div class="card-inner">
                            <div class="tab-content">
                                <div class="tab-pane active" id="dailyCase">
                                    <h6 class="lead-text">Daily New Cases Per Day</h6>
                                    <div class="nk-cov-modal-ck">
                                        <canvas class="covid-case-bar-chart" id="dailyCaseDay"></canvas>
                                    </div>
                                    <div class="justify-between ms-5">
                                        <div class="chart-label small text-soft">22 Jan, 2020</div>
                                        <div class="chart-label small text-soft">28 Mar, 2020</div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="dailyDeaths">
                                    <h6 class="lead-text">Daily New Deaths Per Day</h6>
                                    <div class="nk-cov-modal-ck">
                                        <canvas class="covid-case-bar-chart" id="dailyDeathsDay"></canvas>
                                    </div>
                                    <div class="justify-between ms-5">
                                        <div class="chart-label small text-soft">22 Jan, 2020</div>
                                        <div class="chart-label small text-soft">28 Mar, 2020</div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="dailyCompare">
                                    <h6 class="lead-text">Daily New Cases Compare</h6>
                                    <div class="nk-cov-modal-ck">
                                        <canvas class="covid-case-bar-chart" id="dailyCompareDay"></canvas>
                                    </div>
                                    <div class="justify-between ms-5">
                                        <div class="chart-label small text-soft">22 Jan, 2020</div>
                                        <div class="chart-label small text-soft">28 Mar, 2020</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div><!-- .modal -->
    <!-- JavaScript -->
    <script src="{{ asset('assets/js/bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/editors/summernote.css') }}">
    <script src="{{ asset('assets/js/libs/editors/summernote.js') }}"></script>
    <script src="{{ asset('assets/js/editors.js') }}"></script>
    <script src="{{ asset('assets0/js/libs/jqvmap.js') }}"></script>
    <script src="{{ asset('assets0/js/chart-covid.js') }}"></script>
    <!-- End Custom JavaScript -->
    {{-- <script src="{{ asset('script-map-leaflet.js') }}"></script> --}}
    <script src="{{ asset('js/custom-scripts.js') }}"></script>

    <script src="{{ asset('js/example-sweetalert.js') }}"></script>
    @stack('scripts')
    {{-- @livewireScripts --}}
    @stack('modals')
</body>

</html>
