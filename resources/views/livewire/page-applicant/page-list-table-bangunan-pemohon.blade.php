<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title text-primary">Aplikasi Manajemen Bangunan Gedung
                        <span class="overline-title text-warning badge-dim bg-outline-warning badge-md">AMANBANG</span>
                    </h3>
                    <p class="text-black">
                        <span class="badge bg-primary badge-dim">Bersama Kami Semua Pengurusan Berkas Bangunan
                            Akan
                            Semakin
                            Mudah~!</span>
                </div><!-- .nk-block-head-content -->
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="javascript:void(0)" class="btn btn-icon btn-trigger toggle-expand me-n1"
                            data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>

                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt">
                                    <a href="https://simbg.pu.go.id/" target="_blank"
                                        class="btn btn-primary btn-block d-flex align-items-center justify-content-center">
                                        <em class="icon ni ni-forward me-1"></em>
                                        <span class="btn-text">SIMBG</span>
                                        <span class="spinner-border spinner-border-sm ms-2 d-none"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div><!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <div class="row justify-content-center">
                <div class="col-xxl-12" style="align-content: center">
                    <img src="{{ asset('images/proses-amanbang.webp') }}"
                         class="img-fluid fokus-img"
                         alt="welcome">
                </div>

                <div class="col-xxl-12">
                    <div class="row g-gs">
                        <div class="col-xxl-4 col-sm-12">
                            <div class="card">
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">Total Pengajuan</h6>
                                            </div>
                                            <div class="card-tools">
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" wire:click.prevent=""
                                                        class="btn btn-sm btn-icon btn-trigger link-on-danger"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Lihat Data">
                                                        <em class="icon ni ni-focus"></em>
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="data">
                                            <div class="data-group">
                                                <div class="amount text-primary">{{ $this->getTotalPengajuanPemohon() }}
                                                </div>
                                            </div>
                                            <div class="info"><em class="small"><small>Jumlah merupakan Data Yang
                                                        Diajukan
                                                        Selama ini</em></small></div>
                                        </div>
                                    </div><!-- .card-inner -->
                                </div><!-- .nk-ecwg -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-xxl-4 col-sm-12">
                            <div class="card">
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">Total Pengajuan Selesai </h6>
                                            </div>
                                            <div class="card-tools">
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-sm btn-icon btn-trigger link-on-danger"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Lihat Data">
                                                        <em class="icon ni ni-focus"></em>
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="data">
                                            <div class="data-group">
                                                <div class="amount text-warning">{{ $this->getTotalPengajuanPemohonByStatus('3') }}
                                                </div>
                                            </div>
                                            <div class="info"><em class="small"><small>Jumlah merupakan Data Yang
                                                        Diajukan
                                                        Selama ini</em></small></div>
                                        </div>
                                    </div><!-- .card-inner -->
                                </div><!-- .nk-ecwg -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-xxl-4 col-sm-12">
                            <div class="card">
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">Total Pengajuan Dalam Proses</h6>
                                            </div>

                                            <div class="card-tools">
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-sm btn-icon btn-trigger link-on-danger"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Lihat Data">
                                                        <em class="icon ni ni-focus"></em>
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="data">
                                            <div class="data-group">
                                                <div class="amount text-success">{{ $this->getTotalPengajuanPemohonByStatus('2') }}</div>
                                            </div>
                                            <div class="info"><em class="small"><small>Jumlah merupakan Data Yang
                                                        Diajukan
                                                        Tahun ini</em></small></div>
                                        </div>
                                    </div><!-- .card-inner -->
                                </div><!-- .nk-ecwg -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                    </div>
                </div>
            </div>
        </div><!-- .nk-block -->
    </div><!-- .nk-block-head -->
    <hr>
    <div class="nk-block">
        @livewire('data.table-pengajuan-pemohon')
    </div>
</div>
