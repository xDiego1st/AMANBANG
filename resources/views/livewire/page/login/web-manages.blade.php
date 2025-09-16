<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Settings</h3>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-stretch">
                        <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#site"><em class="icon ni ni-laptop"></em><span>General Settings</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#contact"><em class="icon ni ni-info-fill"></em><span>Contact Setting </span></a>
                            </li>
                            @role(['SUPER-ADMIN'])
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#admin"><em class="icon ni ni-user-alt"></em><span>Admin Settings</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#usertoken"><em class="icon ni ni-info-fill"></em><span>API Tokens </span></a>
                            </li>
                            @endrole
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="site">
                                <div class="pt-0 card-inner">
                                    <h4 class="title nk-block-title">General setting</h4>
                                    <p>Here is your basic store setting of your app.</p>
                                    <form action="#" class="gy-3 form-settings">
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-label" for="comp-name">Website Name</label>
                                                    <span class="form-note">Specify the name of your Company.</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="comp-name" value="Company Name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-label" for="comp-email">Email</label>
                                                    <span class="form-note">Specify the email address of your Company.</span>
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
                                                    <label class="form-label" for="comp-copyright">Phone</label>
                                                    <span class="form-note">Copyright information of your Company.</span>
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
                                                    <label class="form-label" for="site-name">Address</label>
                                                    <span class="form-note">Address your Company.</span>
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
                                                    <label class="form-label" for="site-name">Footer Info</label>
                                                    <span class="form-note">Describe your Website.</span>
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
                                                    <label class="form-label" for="site-off">Maintanance Mode</label>
                                                    <span class="form-note">Enable to make website make offline.</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="reg-public" id="site-off">
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
                            <div class="tab-pane" id="contact">
                                <div class="pt-0 card-inner">
                                    <h4 class="title nk-block-title">Contact setting</h4>
                                    <p>Link of all the Contact profiles.</p>
                                    <form action="#" class="gy-3 form-settings">
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-label" for="comp-name">Facebook</label>
                                                    <span class="form-note">Facebook Page URL (facebook_url) * </span>
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
                                                    <span class="form-note"> Twitter Profile URL (twitter_url) * </span>
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
                                                    <span class="form-note">Instagram Account URL (instagram_url) * </span>
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
                                                    <span class="form-note">LinkedIn URL (linkedin_url) * </span>
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
                                                    <span class="form-note">Youtube Channel URL (youtube_url) * </span>
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

                            @role(['SUPER-ADMIN'])
                            <!--tab pan -->
                            <div class="tab-pane" id="admin">
                                <div class="pt-0 card-inner position-relative card-tools-toggle">
                                    <div class="nk-block-between g-3">
                                        <div class="nk-block-head-content">
                                            <h4 class="nk-block-title title">Admin List</h4>
                                        </div><!-- .nk-block-head-content -->
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="javascript:void(0)" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                <div class="toggle-expand-content" data-content="pageMenu">
                                                    <ul class="nk-block-tools g-3">
                                                        <li><a href="javascript:void(0)" class="btn btn-white btn-outline-light"><em class="icon ni ni-download-cloud"></em><span>Export</span></a></li>
                                                        <li class="nk-block-tools-opt"><a data-bs-toggle="modal" href="#addAdmin" class="text-white btn bg-primary"><em class="icon ni ni-plus"></em><span>Add Admin</span></a></li>
                                                    </ul>
                                                </div>
                                            </div><!-- .toggle-wrap -->
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div>

                                <div class="nk-block">
                                    <div class="card card-preview">
                                        <div class="card-inner">
                                            <table class="datatable-init-export nowrap nk-tb-list nk-tb-ulist" data-auto-responsive="false" id='datatable1'>
                                                <thead>
                                                    <tr class="nk-tb-item nk-tb-head">
                                                        <th class="nk-tb-col nk-tb-col-check notexport">
                                                            <div class="custom-control custom-control-sm custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="uid">
                                                                <label class="custom-control-label" for="uid"></label>
                                                            </div>
                                                        </th>
                                                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Username</span></th>
                                                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Name</span></th>
                                                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Role</span></th>
                                                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                                        <th class="nk-tb-col nk-tb-col-tools text-end notexport">
                                                            Tools
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data as $i)
                                                    <tr class="nk-tb-item">
                                                        <td class="nk-tb-col nk-tb-col-check">
                                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                <input type="checkbox" class="custom-control-input" id="uid1">
                                                                <label class="custom-control-label" for="uid1"></label>
                                                            </div>
                                                        </td>
                                                        <td class="nk-tb-col tb-col-lg">
                                                            <span class="tb-amount">{{$i->username}}</span>
                                                        </td>
                                                        <td class="nk-tb-col">
                                                            <div class="user-card">
                                                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                                @if (Auth::user()->profile_photo_path)
                                                                <img class="user-avatar sm" src="{{Auth::user()->profile_photo_url}}">
                                                                @else
                                                                <img class="user-avatar sm" src="{{ Avatar::create(Auth::user()->name)->toBase64() }}">
                                                                @endif
                                                                @endif
                                                                <div class="user-name">
                                                                    <span class="tb-lead">{{$i->name}}</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="nk-tb-col">
                                                            <span class="badge text-medium text-primary">Co-Admin</span>
                                                        </td>
                                                        <td class="nk-tb-col tb-col-lg">
                                                            <span class="tb-status bg-success badge badge-dot">Active</span>
                                                        </td>
                                                        <td class="nk-tb-col nk-tb-col-tools">
                                                            <ul class="nk-tb-actions gx-1">
                                                                <li class="nk-tb-action-hidden">
                                                                    <a href="javascript:void(0)" class="btn btn-trigger btn-icon" data-bs-toggle="modal" data-bs-target="#modalCreateEditBus" data-bs-toggle="tooltip" data-bs-placement="top" title="Quick Edit">
                                                                        <em class="icon ni ni-focus"></em>
                                                                    </a>
                                                                </li>
                                                                <li class="nk-tb-action-hidden">
                                                                    <a href="javascript:void(0)" class="btn btn-trigger btn-icon" title="Quick Delete">
                                                                        <em class="icon ni ni-trash"></em>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <div class="drodown">
                                                                        <a href="javascript:void(0)" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                            <ul class="link-list-opt no-bdr">
                                                                                <li><a href="javascript:void(0)"><em class="icon ni ni-focus"></em><span>View Detail</span></a></li>
                                                                                <li><a href="javascript:void(0)"><em class="icon ni ni-na"></em><span>Delete Data</span></a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr><!-- .nk-tb-item  -->
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- .card-preview -->
                                </div><!-- .nk-block -->
                            </div>
                            <div class="tab-pane" id="usertoken">
                                <div class="pt-0 card-inner">
                                    @livewire('api.api-token-manager')
                                </div>
                            </div>
                            @endrole
                        </div><!-- .tab-content -->
                    </div>
                    <!--card-->
                </div>
                <!--nk-block-->
            </div>
        </div>
    </div>
</div>
