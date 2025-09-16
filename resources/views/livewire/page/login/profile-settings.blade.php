<div class="nk-content-body">
    {{-- @if (!$user->two_factor_secret)

    <div class="alert alert-pro alert-danger alert-dismissible">
        <div class="alert-text">
            <h6>Warning!</h6>
            <p>Kamu Harus Mengaktifkan <span class="badge bg-danger">Two Factor Authentication</span> Terlebih Dahulu Seblum Dapat Mengakses Sistem</p>
        </div>
        <button class="close" data-bs-dismiss="alert"></button>
    </div>
    @endif --}}
    @if (!$user->status_account)
        <div class="alert alert-pro alert-info alert-dismissible">
            <div class="alert-text">
                <h6 class="text-success-emphasis">Selamat Datang Di {{ config('app.name') }}</h6>
                <p class="text-dark">
                    <span class="text-danger fw-semibold">
                        ⚠️ Mohon lengkapi data diri Anda
                        @role(['PENGAWAS', 'VERIFIKATOR'])
                            Serta Tanda Tangan Digital Anda
                        @endrole
                        pada bagian <span class="badge bg-danger">Informasi
                            Profil</span> terlebih dahulu
                        untuk dapat mengakses seluruh fitur layanan yang tersedia.
                    </span>
                </p>


            </div>
            <button class="close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-stretch">
            <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#profile"><em
                            class="icon ni ni-info-fill"></em><span>Profile Settings</span></a>
                </li>
                @if ($user->role == 'ADMIN')
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#site"><em
                                class="icon ni ni-laptop"></em><span>General Settings</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#admin"><em
                                class="icon ni ni-user-alt"></em><span>Admin Settings</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#contact"><em
                                class="icon ni ni-info-fill"></em><span>Contact Setting </span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#usertoken"><em
                                class="icon ni ni-info-fill"></em><span>API Tokens </span></a>
                    </li>
                @endif

            </ul>
            <div class="tab-content">

                <div class="tab-pane active" id="profile">
                    <div class="card-inner">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            @livewire('profile.update-profile-information-form')

                            <x-section-border />
                        @endif
                        @role(['VERIFIKATOR', 'PENGAWAS'])
                            @livewire('forms.form-signatures')
                            <x-section-border />
                        @endrole
                        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.update-password-form')
                            </div>

                            <x-section-border />
                        @endif

                        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.two-factor-authentication-form')
                            </div>

                            <x-section-border />
                        @endif

                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.logout-other-browser-sessions-form')
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                            <x-section-border />

                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.delete-user-form')
                            </div>
                        @endif
                    </div>
                </div>
                @if ($user->role == 'ADMIN')
                    <div class="tab-pane" id="site">
                        <div class="pt-0 card-inner">
                            <h4 class="title nk-block-title">General setting</h4>
                            <p>Here is your basic store setting of your app.</p>
                            <form action="#" class="gy-3 form-settings">
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="comp-name">Company
                                                Name</label>
                                            <span class="form-note">Specify the name of your
                                                Company.</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="comp-name"
                                                    value="Company Name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="comp-email">Company
                                                Email</label>
                                            <span class="form-note">Specify the email address of your
                                                Company.</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="comp-email">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="comp-copyright">Company
                                                Copyright</label>
                                            <span class="form-note">Copyright information of your
                                                Company.</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="comp-copyright">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label">Allow Registration</label>
                                            <span class="form-note">Enable or disable registration from
                                                site.</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <ul class="flex-wrap custom-control-group g-3 align-center">
                                            <li>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" checked
                                                        name="reg-public" id="reg-enable">
                                                    <label class="custom-control-label"
                                                        for="reg-enable">Enable</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input"
                                                        name="reg-public" id="reg-disable">
                                                    <label class="custom-control-label"
                                                        for="reg-disable">Disable</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input"
                                                        name="reg-public" id="reg-request">
                                                    <label class="custom-control-label" for="reg-request">On
                                                        Request</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label">Main Website</label>
                                            <span class="form-note">Specify the URL if your main
                                                website is external.</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="site-url">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="site-name"> Website
                                                description</label>
                                            <span class="form-note">Describe your website.</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control" id="fv-message" name="fv-message"> </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="site-off">Maintanance
                                                Mode</label>
                                            <span class="form-note">Enable to make website make
                                                offline.</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="reg-public"
                                                    id="site-off">
                                                <label class="custom-control-label" for="site-off">Offline</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-lg-7">
                                        <div class="mt-2 form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--tab pan -->
                    <div class="tab-pane" id="admin">
                        <div class="pt-0 card-inner position-relative card-tools-toggle">
                            <div class="nk-block-between g-3">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title title">Admin List</h4>
                                </div><!-- .nk-block-head-content -->
                                <div class="nk-block-head-content">
                                    <div class="toggle-wrap nk-block-tools-toggle">
                                        <a href="javascript:void(0)"
                                            class="btn btn-icon btn-trigger toggle-expand me-n1"
                                            data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                        <div class="toggle-expand-content" data-content="pageMenu">
                                            <ul class="nk-block-tools g-3">
                                                <li><a href="javascript:void(0)"
                                                        class="btn btn-white btn-outline-light"><em
                                                            class="icon ni ni-download-cloud"></em><span>Export</span></a>
                                                </li>
                                                <li class="nk-block-tools-opt"><a data-bs-toggle="modal"
                                                        href="#addAdmin" class="text-white btn bg-primary"><em
                                                            class="icon ni ni-plus"></em><span>Add
                                                            Admin</span></a></li>
                                            </ul>
                                        </div>
                                    </div><!-- .toggle-wrap -->
                                </div><!-- .nk-block-head-content -->
                            </div><!-- .nk-block-between -->
                        </div>
                    </div>
                    <!--tab pan -->
                    <div class="tab-pane" id="contact">
                        <div class="pt-0 card-inner">
                            <h4 class="title nk-block-title">Contact setting</h4>
                            <p>Link of all the Contact profiles.</p>
                            <form action="#" class="gy-3 form-settings">
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="comp-name">Facebook</label>
                                            <span class="form-note">Facebook Page URL (facebook_url) *
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="comp-name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="comp-email">Twitter</label>
                                            <span class="form-note"> Twitter Profile URL (twitter_url)
                                                * </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="comp-email">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="comp-copyright">Instagram</label>
                                            <span class="form-note">Instagram Account URL
                                                (instagram_url) * </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="comp-copyright">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="comp-copyright">LinkedIn</label>
                                            <span class="form-note">LinkedIn URL (linkedin_url) *
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="comp-copyright">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="comp-copyright">Youtube</label>
                                            <span class="form-note">Youtube Channel URL (youtube_url) *
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="comp-copyright">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-lg-7">
                                        <div class="mt-2 form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane" id="usertoken">
                        <div class="card-inner">
                            @livewire('api.api-token-manager')
                        </div>
                    </div>
                @endif
            </div><!-- .tab-content -->
        </div>
        <!--card-->
    </div>
    <!--nk-block-->
</div>
