<x-guest-layout>
    <div class="nk-split nk-split-page nk-split-lg">
        <div class="bg-white nk-split-content nk-block-area nk-block-area-column nk-auth-container overlay-background">
            <div class="p-3 absolute-top-right d-lg-none p-sm-5">
                <a href="#" class="toggle btn-white btn btn-icon btn-light" data-target="athPromo"><em
                        class="icon ni ni-info"></em></a>
            </div>
            <div class="nk-block nk-block-middle nk-auth-body">
                <div class="pb-5 brand-logo">
                    <a href="javascript:void(0)" class="logo-link">
                        <img class="logo-light logo-img logo-img-lg" src="./images/logo.png">
                        <img class="logo-dark logo-img logo-img-lg" src="./images/logo-dark.png">
                    </a>
                    <a href="javascript:void(0)" class="logo-link">
                        <img class="logo-light logo-img logo-img-lg" src="{{ asset('images/LOGO_KOMINFO.png') }}">
                        <img class="logo-dark logo-img logo-img-lg" src="{{ asset('images/LOGO_KOMINFO.png') }}">
                    </a>
                    <a href="javascript:void(0)" class="logo-link">
                        <img class="logo-img logo-img-lg" src="{{ asset('images/LOGO-PUPR.png') }}">
                        <img class="logo-img logo-img-lg" src="{{ asset('images/LOGO-PUPR.png') }}">
                    </a>
                </div>
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h5 class="nk-block-title">Aplikasi Manajemen Bangunan Gedung [ AMANBANG ]</h5>
                        <div class="nk-block-des">
                            <p>Silahkan login menggunakan akun Anda. </p>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <form method="POST" action="{{ route('login') }}" class="form-validate is-alter" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="email-address">Email or Username</label>
                            <a class="link link-primary link-sm" tabindex="-1" href="javascript:void(0)">Need Help?</a>
                        </div>
                        <div class="form-control-wrap">
                            <input name="email" autocomplete="off" type="text" class="form-control form-control-lg"
                                required id="email" placeholder="Enter your email address or username">
                            @error('email')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="password">Passcode</label>
                        </div>
                        <div class="form-control-wrap">
                            <a tabindex="-1" href="javascript:void(0)"
                                class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input name="password" autocomplete="new-password" type="password"
                                class="form-control form-control-lg" required id="password"
                                placeholder="Enter your passcode">
                            @error('password')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block">Sign in</button>
                    </div>
                    <div class="form-group d-flex align-items-center justify-content-between">
                        <label class="d-flex align-items-center">
                            <div class="custom-control custom-control-xs custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="checkbox" name="remember">
                                <label class="custom-control-label text-secondary" for="checkbox">Ingat Saya</label>
                            </div>
                        </label>

                        <a href="{{ route('password.request') }}" class="link">Lupa password?</a>
                    </div>

                    {{-- <span class="p-1 pb-2 overline-title">Or Login By</span> --}}
                </form><!-- form -->
                <div class="pt-4 cursor-pointer form-note-s2 text-bold">Belum Punya Akun?
                    <a href="{{ route('register.applicant') }}" class="text-black btn btn-warning link-on-white">
                        Buat Akun Disini</a>
                </div>
                {{-- <div class="grid gap-4">
                    <a class="flex items-center justify-center w-full text-sm transition duration-200 border border-gray-400 rounded-lg shadow-sm hover:shadow-md"
                        style="
                    padding-top: 0.375rem !important;
                    padding-bottom: 0.375rem !important;"
                        href='{{ route('sso-auth-pku.redirect') }}'>
                        <img class="icon icon-sm icon-avatar-md"
                            src="https://sso.pekanbaru.go.id/assets/images/logo-icon.svg" />
                        <span class="block text-sm font-medium text-gray-700">SSO Pekanbaru</span>
                    </a>
                </div> --}}
                <div class="mt-5 text-center">
                    {{-- <span class="fw-500">I don't have an account? <a href="javascript:void(0)">Contact Admin</a></span> --}}
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                {{-- Jika login gagal (password salah), Fortify mengisi $errors dengan key "email" --}}
                @if ($errors->has('email'))
                    @php
                        notify()->error('Email atau password salah.', 'Login Gagal');
                    @endphp
                @endif


            </div><!-- .nk-block -->
            <div class="nk-block nk-auth-footer">
                <div class="nk-block-between">
                    <ul class="nav nav-sm">
                        <li class="nav-item">
                            <a class="nav-link " href="#">Terms & Condition</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Privacy Policy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Help</a>
                        </li>
                    </ul><!-- .nav -->
                </div>
                <div class="mt-3">
                    <p>&copy; 2025 {{ config('app.name') }}. All Rights Reserved.</p>
                </div>
            </div><!-- .nk-block -->
        </div><!-- .nk-split-content -->
        {{-- <img src="{{ asset('images/login-banner.webp') }}"
            class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide toggle-slide-right"
            data-toggle-body="true" data-content="athPromo" data-toggle-screen="lg" data-toggle-overlay="true"> --}}

        <div class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide toggle-slide-right"
            data-toggle-body="true" data-content="athPromo" data-toggle-screen="lg" data-toggle-overlay="true">
            <div class="p-3 m-auto slider-wrap w-100 w-max-550px p-sm-5">
                <div class="slider-init" data-slick='{"dots":true, "arrows":false}'>
                    <div class="slider-item">
                        <div class="nk-feature nk-feature-center">
                            <div class="nk-feature-img">
                                <img class="round" src="{{ asset('images/login-banner.webp') }}"
                                    srcset="{{ asset('images/login-banner.webp') }}" alt="">
                            </div>
                        </div>
                    </div><!-- .slider-item -->
                    <div class="slider-item">
                        <div class="nk-feature nk-feature-center">
                            <div class="nk-feature-img">
                                <img class="round" src="{{ asset('images/alur-proses-percepatan-simbg-amanbang.png') }}"
                                    srcset="{{ asset('images/alur-proses-percepatan-simbg-amanbang.png') }}" alt="">
                            </div>
                        </div>
                    </div><!-- .slider-item -->
                </div><!-- .slider-init -->
                <div class="slider-dots"></div>
                <div class="slider-arrows"></div>
            </div><!-- .slider-wrap -->
        </div><!-- .nk-split-content -->
    </div><!-- .nk-split -->
</x-guest-layout>
