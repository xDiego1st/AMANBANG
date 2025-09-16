<div>
    <div class="modal fade" id="ModalFormUser" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $data ? "Edit Data User#" : "Tambah Data" }} User {{ isset($data) ? $data->name : "Baru" }}</h5>
                    <a href="javascript:void(0)" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form class="form-validate is-alter">
                        <div class="preview-block">
                            <span class="preview-title-lg overline-title">Account Information</span>
                            <div class="row gy-4">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Full Name</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="default-01" placeholder="Input Full Name" wire:model="name">
                                            @error('name')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6"  wire:ignore>
                                    <x-custom.forms.select2-pluck data="roles" model="role" label="Role" labelDetail="Pilih Role User"  viewLabel="true"/>
                                </div>
                                <div class="col-sm-6" {{ $data ? 'hidden' :'' }}>
                                    <div class="form-group">
                                        <label class="form-label" for="default-03">Username</label>
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-left">
                                                <em class="icon ni ni-user"></em>
                                            </div>
                                            <input type="text" class="form-control" id="default-03" placeholder="Input username" wire:model="username">
                                            @error('username')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-04">Email Address</label>
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right">
                                                <em class="icon ni ni-mail"></em>
                                            </div>
                                            <input type="text" class="form-control" id="default-04" placeholder="Input Email" wire:model="email">
                                            @error('email')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6" {{ $data ? 'hidden' :'' }}>
                                    <div class="form-group">
                                        <label class="form-label" for="input-password">Password</label>
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-left">
                                                <em class="icon ni ni-lock"></em>
                                            </div>
                                            <input type="password" class="form-control" id="input-password" placeholder="Input password" wire:model="password">
                                            @error('password')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="input-nohp" data-bs-toggle="tooltip" data-bs-placement="top" title="No WA/HP Bersifat Optional">
                                            No WA
                                            <span class="text-danger"><em class="icon ni ni-info-i"></em></span>
                                        </label>
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right">
                                                <em class="icon ni ni-call"></em>
                                            </div>
                                            <input type="text" class="form-control" id="input-nohp" placeholder="Input No HP / WA" wire:model="no_wa">
                                            @error('no_wa')
                                            <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <ul class="mt-1 d-flex justify-content-between gx-4">
                                        <li>
                                            <a href="javascript:void(0)" wire:click='submit' class="btn btn-primary">Submit</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" data-bs-dismiss="modal" class="btn btn-danger btn-dim">Discard</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
