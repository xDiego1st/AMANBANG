<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Daftar Pengajuan Berita Acara Pemohon</h3>
                <div class="nk-block-des text-soft">
                    <p>Anda Memiliki Total Dokumen Berita Acara Yang Perlu Ditandatangani.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                            class="icon ni ni-menu-alt-r"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li><a href="#" class="btn btn-white btn-outline-light"><em
                                        class="icon ni ni-download-cloud"></em><span>Export</span></a></li>
                            <li class="nk-block-tools-opt">
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-primary"
                                        data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#"><span>Add User</span></a></li>
                                            <li><a href="#"><span>Add Team</span></a></li>
                                            <li><a href="#"><span>Import User</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div><!-- .toggle-wrap -->
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row g-gs">
            @foreach ($data as $i)
                <div class="col-sm-6 col-lg-4 col-xxl-3">
                    <div class="card">
                        <div class="card-inner">
                            <div class="team">
                                <div class="text-white team-status bg-warning"><em class="icon ni ni-clock"></em></div>
                                <div class="team-options">
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger"
                                            data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="#"><em class="icon ni ni-focus"></em><span>Quick
                                                            View</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-eye"></em><span>View
                                                            Details</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-mail"></em><span>Send
                                                            Email</span></a></li>
                                                <li class="divider"></li>
                                                <li><a href="#"><em
                                                            class="icon ni ni-shield-star"></em><span>Reset
                                                            Pass</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-shield-off"></em><span>Reset
                                                            2FA</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-na"></em><span>Suspend
                                                            User</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-card user-card-s2">
                                    {{-- <div class="user-avatar md bg-danger">
                                        <span>JM</span>
                                        <div class="status dot dot-lg dot-success"></div>
                                    </div> --}}
                                    <div class="user-info">
                                        <h6>{{ $i->nama }}</h6>
                                        <span class="sub-text">{{ $i->nomor_registrasi_simbg }}</span>
                                    </div>
                                </div>
                                <hr>
                                <embed src="{{ asset('images/TemplateForm/KRK Example.pdf') }}" type="application/pdf"
                                    width="100%" height="400px">
                                <hr>
                                <ul class="team-statistics">
                                    <li><span>213</span><span>Projects</span></li>
                                    <li><span>87.5%</span><span>Performed</span></li>
                                    <li><span>587</span><span>Tasks</span></li>
                                </ul>
                                <div class="team-view">
                                    <a href="#" wire:click='konfirmasiBA'
                                        class="btn btn-round btn-outline-success w-150px"><span>Konfirmasi</span></a>
                                </div>
                            </div><!-- .team -->
                        </div><!-- .card-inner -->
                    </div><!-- .card -->
                </div><!-- .col -->
            @endforeach
        </div>
    </div><!-- .nk-block -->
</div>
