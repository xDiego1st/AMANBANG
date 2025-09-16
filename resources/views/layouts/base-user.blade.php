<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-wide" dir="ltr" data-theme="theme-default"
    data-assets-path="../../../../../assets_vuexy/" data-template="front-pages" data-style="light">

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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets_vuexy/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets_vuexy/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets_vuexy/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->

    <link rel="stylesheet"
        href="{{ asset('assets_vuexy/vendor/css/rtl/core.css" class="template-customizer-core-css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets_vuexy/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css') }}" />

    <link rel="stylesheet" href="{{ asset('assets_vuexy/css/demo.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets_vuexy/vendor/css/pages/front-page.css') }}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets_vuexy/vendor/libs/node-waves/node-waves.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets_vuexy/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets_vuexy/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets_vuexy/vendor/libs/rateyo/rateyo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets_vuexy/vendor/libs/@form-validation/form-validation.css') }}" />

    <!-- Page CSS -->

    <link rel="stylesheet" href="{{ asset('assets_vuexy/vendor/css/pages/wizard-ex-checkout.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets_vuexy/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('assets_vuexy/vendor/js/template-customizer.js') }}"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets_vuexy/js/front-config.js') }}"></script>
</head>

<body>
    <script src="{{ asset('assets_vuexy/vendor/js/dropdown-hover.js') }}"></script>
    <script src="{{ asset('assets_vuexy/vendor/js/mega-dropdown.js') }}"></script>

    <!-- Navbar: Start -->
    <nav class="py-0 shadow-none layout-navbar">
        <div class="container">
            <div class="px-3 navbar navbar-expand-lg landing-navbar px-md-8">
                <!-- Menu logo wrapper: Start -->
                <div class="py-0 navbar-brand app-brand demo d-flex py-lg-2 me-4 me-xl-8">
                    <!-- Mobile menu toggle: Start-->
                    <button class="px-0 border-0 navbar-toggler me-4" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="align-middle ti ti-menu-2 ti-lg text-heading fw-medium"></i>
                    </button>
                    <!-- Mobile menu toggle: End-->
                    <a href="landing-page.html" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <svg width="32" height="22" viewBox="0 0 32 22" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                    fill="#7367F0" />
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                                    fill="#161616" />
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                                    fill="#161616" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                    fill="#7367F0" />
                            </svg>
                        </span>
                        <span class="app-brand-text demo menu-text fw-bold ms-2 ps-1">AMANBANG - APLIKASI MANAJEMEN GEDUNG BANGUNAN</span>
                    </a>
                </div>
                <!-- Menu logo wrapper: End -->
                <!-- Menu wrapper: Start -->
                <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
                    <button class="top-0 border-0 navbar-toggler text-heading position-absolute end-0 scaleX-n1-rtl"
                        type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti ti-x ti-lg"></i>
                    </button>
                    {{-- <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link fw-medium" aria-current="page"
                                href="landing-page.html#landingHero">Home</a>
                        </li>
                    </ul> --}}
                </div>
                <div class="landing-menu-overlay d-lg-none"></div>
                <!-- Menu wrapper: End -->
                <!-- Toolbar: Start -->
                <ul class="flex-row navbar-nav align-items-center ms-auto">
                    <!-- Style Switcher -->
                    <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-1">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                            data-bs-toggle="dropdown">
                            <i class="ti ti-lg"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                                    <span class="align-middle"><i class="ti ti-sun me-3"></i>Light</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                                    <span class="align-middle"><i class="ti ti-moon-stars me-3"></i>Dark</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                                    <span class="align-middle"><i
                                            class="ti ti-device-desktop-analytics me-3"></i>System</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- / Style Switcher-->

                    <!-- navbar button: Start -->
                    <li>
                        <a href="../vertical-menu-template/auth-login-cover.html" class="btn btn-danger"
                            target="_blank"><span class="tf-icons ti ti-login scaleX-n1-rtl me-md-1"></span><span
                                class="d-none d-md-block">Logout</span></a>
                    </li>
                    <!-- navbar button: End -->
                </ul>
                <!-- Toolbar: End -->
            </div>
        </div>
    </nav>
    <!-- Navbar: End -->

    <!-- Sections:Start -->

    {{ $slot }}

    <!-- / Sections:End -->

    <!-- Footer: Start -->
    <footer class="landing-footer bg-body footer-text">
        <div class="overflow-hidden footer-top position-relative z-1">
            <img src="../../assets/img/front-pages/backgrounds/footer-bg-light.png" alt="footer bg"
                class="footer-bg banner-bg-img z-n1" data-app-light-img="front-pages/backgrounds/footer-bg-light.png"
                data-app-dark-img="front-pages/backgrounds/footer-bg-dark.png" />
            <div class="container">
                <div class="row gx-0 gy-6 g-lg-10">
                    <div class="col-lg-5">
                        <a href="landing-page.html" class="mb-6 app-brand-link">
                            <span class="app-brand-logo demo">
                                <svg width="32" height="22" viewBox="0 0 32 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                        fill="#7367F0" />
                                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                                        fill="#161616" />
                                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                                        fill="#161616" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                        fill="#7367F0" />
                                </svg>
                            </span>
                            <span class="app-brand-text demo footer-link fw-bold ms-2 ps-1">Vuexy</span>
                        </a>
                        <p class="mb-6 footer-text footer-logo-description">
                            Most developer friendly & highly customisable Admin Dashboard Template.
                        </p>
                        <form class="footer-form">
                            <label for="footer-email" class="small">Subscribe to newsletter</label>
                            <div class="mt-1 d-flex">
                                <input type="email"
                                    class="form-control rounded-0 rounded-start-bottom rounded-start-top"
                                    id="footer-email" placeholder="Your email" />
                                <button type="submit"
                                    class="shadow-none btn btn-primary rounded-0 rounded-end-bottom rounded-end-top">
                                    Subscribe
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <h6 class="mb-6 footer-title">Demos</h6>
                        <ul class="list-unstyled">
                            <li class="mb-4">
                                <a href="../vertical-menu-template/" target="_blank" class="footer-link">Vertical
                                    Layout</a>
                            </li>
                            <li class="mb-4">
                                <a href="../horizontal-menu-template/" target="_blank" class="footer-link">Horizontal
                                    Layout</a>
                            </li>
                            <li class="mb-4">
                                <a href="../vertical-menu-template-bordered/" target="_blank"
                                    class="footer-link">Bordered Layout</a>
                            </li>
                            <li class="mb-4">
                                <a href="../vertical-menu-template-semi-dark/" target="_blank"
                                    class="footer-link">Semi Dark Layout</a>
                            </li>
                            <li class="mb-4">
                                <a href="../vertical-menu-template-dark/" target="_blank" class="footer-link">Dark
                                    Layout</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <h6 class="mb-6 footer-title">Pages</h6>
                        <ul class="list-unstyled">
                            <li class="mb-4">
                                <a href="pricing-page.html" class="footer-link">Pricing</a>
                            </li>
                            <li class="mb-4">
                                <a href="payment-page.html" class="footer-link">Payment<span
                                        class="badge bg-primary ms-2">New</span></a>
                            </li>
                            <li class="mb-4">
                                <a href="checkout-page.html" class="footer-link">Checkout</a>
                            </li>
                            <li class="mb-4">
                                <a href="help-center-landing.html" class="footer-link">Help Center</a>
                            </li>
                            <li class="mb-4">
                                <a href="../vertical-menu-template/auth-login-cover.html" target="_blank"
                                    class="footer-link">Login/Register</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <h6 class="mb-6 footer-title">Download our app</h6>
                        <a href="javascript:void(0);" class="mb-4 d-block"><img
                                src="../../assets/img/front-pages/landing-page/apple-icon.png" alt="apple icon" /></a>
                        <a href="javascript:void(0);" class="d-block"><img
                                src="../../assets/img/front-pages/landing-page/google-play-icon.png"
                                alt="google play icon" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-3 footer-bottom py-md-5">
            <div
                class="container flex-wrap text-center d-flex justify-content-between flex-md-row flex-column text-md-start">
                <div class="mb-2 mb-md-0">
                    <span class="footer-bottom-text">©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                    </span>
                    <a href="https://pixinvent.com" target="_blank" class="text-white fw-medium">Pixinvent,</a>
                    <span class="footer-bottom-text"> Made with ❤️ for a better web.</span>
                </div>
                <div>
                    <a href="https://github.com/pixinvent" class="me-3" target="_blank">
                        <img src="../../assets/img/front-pages/icons/github.svg" alt="github icon" />
                    </a>
                    <a href="https://www.facebook.com/pixinvents/" class="me-3" target="_blank">
                        <img src="../../assets/img/front-pages/icons/facebook.svg" alt="facebook icon" />
                    </a>
                    <a href="https://twitter.com/pixinvents" class="me-3" target="_blank">
                        <img src="../../assets/img/front-pages/icons/twitter.svg" alt="twitter icon" />
                    </a>
                    <a href="https://www.instagram.com/pixinvents/" target="_blank">
                        <img src="../../assets/img/front-pages/icons/instagram.svg" alt="google icon" />
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer: End -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets_vuexy/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets_vuexy/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets_vuexy/vendor/libs/node-waves/node-waves.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets_vuexy/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets_vuexy/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets_vuexy/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script src="{{ asset('assets_vuexy/vendor/libs/rateyo/rateyo.js') }}"></script>
    <script src="{{ asset('assets_vuexy/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets_vuexy/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets_vuexy/vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ asset('assets_vuexy/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('assets_vuexy/vendor/libs/@form-validation/auto-focus.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets_vuexy/js/front-main.js') }}"></script>

    <!-- Page JS -->

    <script src="{{ asset('assets_vuexy/js/modal-add-new-address.js') }}"></script>
    <script src="{{ asset('assets_vuexy/js/wizard-ex-checkout.js') }}"></script>
</body>

</html>
