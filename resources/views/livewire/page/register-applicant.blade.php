<div class="nk-wrap nk-wrap-nosidebar">
    <!-- content @s -->
    <div class="nk-content ">
        <div class="nk-block nk-block-middle nk-auth-body-custom wide-sm">
            <div class="pb-4 text-center brand-logo">
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
            <div class="card">
                <div class="card-inner">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Registrasi Akun AMANBANG</h4>
                            <div class="nk-block-des">
                                <p>Registrasi Pendataan Aplikasi Percepatan SIMBG perihal KRK & Percepatan Validasi
                                    Dokumen PBG / SLF </p>
                            </div>
                        </div>
                    </div>
                    <div class="row g-gs">
                        <span class="preview-title-lg overline-title">Pendataan Akses Masuk Ke AMANBANG</span>
                        <div class="col-sm-12 col-lg-6 col-md-12">
                            <div class="form-label-group">
                                <label class="form-label" for="email-address">Username</label>
                            </div>
                            <div class="form-control-wrap">
                                <input wire:model='username' name="username" autocomplete="off" type="text"
                                    class="form-control form-control-lg" required id="username"
                                    placeholder="Enter your username">
                                @error('username')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="title">Password</label>

                                <div class="form-control-wrap">
                                    <a tabindex="-1" href="javascript:void(0)"
                                        class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                    </a>
                                    <input name="password" autocomplete="new-password" type="password"
                                        class="form-control form-control-lg" required id="password"
                                        placeholder="Enter your passcode" wire:model='password'>
                                    @error('password')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="no_Wa">No.
                                    Whatsapp</label>

                                <span class="text-danger"><em class="icon ni ni-info-i"></em></span>
                                <input type="text" class="form-control" id="no_wa" placeholder="No.WA Pemohon"
                                    wire:model.live='no_wa'>
                                @error('no_wa')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6 col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="email">Email Address</label>

                                <span class="text-danger"><em class="icon ni ni-info-i"></em></span>
                                <input type="text" class="form-control" id="email" placeholder="Perihal"
                                    wire:model.live='email'>
                                @error('email')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <span class="badge badge-lg badge-dim bg-outline-primary text-wrap">Pastikan Anda
                                Memasukkan 'No Whatsapp Anda Yang Aktif' Karena Kami akan memberikan notifikasi
                                'Username dan Password' kembali melalui WA anda</span>

                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button wire:click.prevent='submitRegister' type="button"
                                    class="btn btn-primary btn-lg btn-block">Register</button>
                            </div>
                        </div>
                    </div>
                    {{-- @livewire('page-applicant.form-page-data-pemohon') --}}

                    <div class="pt-4 text-center form-note-s2"> Sudah Punya Akun? <a
                            href="{{ route('login') }}"><strong>Masuk Disini</strong></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-footer nk-auth-footer-custom">
            <div class="container wide-lg-fix">
                <div class="row g-3">
                    <div class="col-lg-6 order-lg-last">
                        <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)">Terms &amp; Condition</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)">Privacy Policy</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)">Help</a>
                            </li> --}}
                            <li class="nav-item dropup active current-page">
                                <a class="dropdown-toggle dropdown-indicator has-indicator nav-link"
                                    data-bs-toggle="dropdown" data-offset="0,10"><span>Indonesia</span></a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                    <ul class="language-list">
                                        <li>
                                            <a href="javascript:void(0)" class="language-item">
                                                <img src="{{ asset('images/flags/english.png') }}" alt=""
                                                    class="language-flag">
                                                <span class="language-name">English</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="language-item">
                                                <img src="{{ asset('images/flags/spanish.png') }}" alt=""
                                                    class="language-flag">
                                                <span class="language-name">Indonesia</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-center nk-block-content text-lg-left">
                            <p class="text-soft">© 2024 PUPR . All Rights Reserved.</p>
                            <br>
                            <p>Developed By <a href="https://sso.pekanbaru.go.id" class="fw-bold"> Diskominfotiksan
                                    Kota Pekanbaru </a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- wrap @e -->
</div>
