<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title text-success">Aplikasi Manajemen Bangunan Gedung -
                    <button class="badge-md text-white badge=dim bg-primary font-mono">AMANBANG</button>
                    <span class="badge-md text-white badge=dim bg-info font-mono">Aplikasi Pendukung SIMBG</span>
                </h3>
                <p class="text-black"><span class="badge bg-danger">Selamat Datang {{ $user->name }}</span>
                    <span
                        class="badge {{ config('styles.type_validator.' . $user->type_validator . '.class') }}">{{ config('styles.type_validator.' . $user->type_validator . '.text') }}</span>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="javascript:void(0)" class="btn btn-icon btn-trigger toggle-expand me-n1"
                        data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            {{-- <li>
                                <div class="drodown">
                                    <a href="javascript:void(0)" class="dropdown-toggle btn btn-white btn-dim btn-outline-light"
                                        data-bs-toggle="dropdown"><em
                                            class="d-none d-sm-inline icon ni ni-calender-date"></em><span><span
                                                class="d-none d-md-inline">Last</span> 30 Days</span><em
                                            class="dd-indc icon ni ni-chevron-right"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="javascript:void(0)"><span>Last 30 Days</span></a></li>
                                            <li><a href="javascript:void(0)"><span>Last 6 Months</span></a></li>
                                            <li><a href="javascript:void(0)"><span>Last 1 Years</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li> --}}
                            <li class="nk-block-tools-opt"><a href="https://simbg.pu.go.id/" target="_blank"
                                    class="btn btn-primary"><em class="icon ni ni-reports"></em><span>SIMBG</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-xxl-3 col-sm-6">
                <div class="card">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Total Pemohon Yang Belum & Sudah Selesai Saat ini</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">
                                        1 <span class="badge bg-success">Selesai</span> |
                                        1 <span class="badge bg-danger">Belum</span>
                                    </div>
                                </div>
                                <div class="info"><em class="small"><small>Jumlah merupakan Pemohon Yang Sudah
                                            terdapat Log / Aktifitas Upload Dokumen</em></small></div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-xxl-3 col-sm-6">
                <div class="card">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Dokumen Pemohon Dalam Status Menunggu</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">
                                        1
                                        <span class="badge bg-outline-info">Dokumen</span>
                                    </div>
                                </div>
                                <div class="info"><em class="small"><small>Jumlah merupakan Pemohon Yang Sudah
                                            terdapat Log / Aktifitas Upload Dokumen</em></small></div>

                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-xxl-3 col-sm-6">
                <div class="card">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Dokumen Pemohon Dalam Status On-Checking</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">1
                                        <span class="badge bg-success">Selesai</span>
                                    </div>
                                </div>
                                <div class="info"><em class="small"><small>Jumlah merupakan Pemohon Yang Sudah
                                            terdapat Log / Aktifitas Upload Dokumen</em></small></div>

                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-xxl-3 col-sm-6">
                <div class="card">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Dokumen Pemohon Dalam Status Need-Correction</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">
                                        1
                                        <span class="badge bg-outline-info">Dokumen</span>
                                    </div>
                                </div>
                                <div class="info"><em class="small"><small>Jumlah merupakan Pemohon Yang Sudah
                                            terdapat Log / Aktifitas Upload Dokumen</em></small></div>

                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div><!-- .col -->
            {{-- <div class="col-xxl-12">
                <livewire:data.table-pemohon-list/>
            </div><!-- .col --> --}}
            <div class="col-xxl-12">
                <livewire:data.table-pemohon-list jenis_pengajuan="PBG" />
            </div><!-- .col -->
            <div class="col-xxl-12">
                <livewire:data.table-pemohon-list jenis_pengajuan="SLF" />
            </div><!-- .col -->
            {{-- <div class="col-md-6 col-xxl-3">
                <div class="card card-full">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Recent Activities Verifikator</h6>
                            </div>
                            <div class="card-tools">
                                <ul class="card-tools-nav">
                                    <li><a href="javascript:void(0)" class="link-on-info">Show More</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nk-activity">
                        <li class="nk-activity-item">
                            <div class="nk-activity-media user-avatar bg-success"><img src="./images/avatar/c-sm.jpg"
                                    alt=""></div>
                            <div class="nk-activity-data">
                                <div class="label">Keith Jensen requested to Widthdrawl.</div>
                                <span class="time">2 hours ago</span>
                            </div>
                        </li>
                        <li class="nk-activity-item">
                            <div class="nk-activity-media user-avatar bg-warning">HS</div>
                            <div class="nk-activity-data">
                                <div class="label">Harry Simpson placed a Order.</div>
                                <span class="time">2 hours ago</span>
                            </div>
                        </li>
                        <li class="nk-activity-item">
                            <div class="nk-activity-media user-avatar bg-azure">SM</div>
                            <div class="nk-activity-data">
                                <div class="label">Stephanie Marshall got a huge bonus.</div>
                                <span class="time">2 hours ago</span>
                            </div>
                        </li>
                        <li class="nk-activity-item">
                            <div class="nk-activity-media user-avatar bg-purple"><img src="./images/avatar/d-sm.jpg"
                                    alt=""></div>
                            <div class="nk-activity-data">
                                <div class="label">Nicholas Carr deposited funds.</div>
                                <span class="time">2 hours ago</span>
                            </div>
                        </li>
                        <li class="nk-activity-item">
                            <div class="nk-activity-media user-avatar bg-pink">TM</div>
                            <div class="nk-activity-data">
                                <div class="label">Timothy Moreno placed a Order.</div>
                                <span class="time">2 hours ago</span>
                            </div>
                        </li>
                    </ul>
                </div><!-- .card -->
            </div><!-- .col --> --}}
        </div><!-- .row -->
    </div><!-- .nk-block -->
</div>

@once
    @push('scripts')
        <script src="{{ asset('assets/js/charts/chart-ecommerce.js') }}"></script>
    @endpush
@endonce
