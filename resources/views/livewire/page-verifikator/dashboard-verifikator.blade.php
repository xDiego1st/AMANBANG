<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title text-success">Aplikasi Manajemen Bangunan Gedung -
                    <span class="font-mono text-white badge-md bg-info">A M A N B A N G</span>
                </h3>
                <hr>
                <p class="text-black"><span class="badge bg-danger">Welcome {{ $user->name }}</span>
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
                                    <h6 class="title">Total Pemohon</h6>
                                </div>
                                <a href="javascript:void(0)" {{-- wire:click.prevent="openModalForListData('tidak_ngukur')" --}}
                                    class="btn btn-sm btn-icon btn-trigger link-on-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Lihat Data">
                                    <em class="icon ni ni-focus"></em>
                                </a>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">
                                        {{ $this->getTotalPengajuanVerifikator() }} <span class="bg-black badge round">Pemohon</span>
                                        |
                                        {{ $this->getTotalPengajuanVerifikator('4') }} <span
                                            class="badge bg-success">Selesai</span>
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
                                    <h6 class="title">Dokumen Pemohon Menunggu Proses Pengecekan</h6>
                                </div>
                                <a href="javascript:void(0)" {{-- wire:click.prevent="openModalForListData('tidak_ngukur')" --}}
                                    class="btn btn-sm btn-icon btn-trigger link-on-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Lihat Data">
                                    <em class="icon ni ni-focus"></em>
                                </a>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">
                                        {{ $this->getTotalPengajuanVerifikator('0') }}
                                        <span class="badge bg-primary">On-Waiting</span>
                                    </div>
                                    <div class="nk-ecwg6-ck">
                                        <canvas class="ecommerce-line-chart-s3" id="todayRevenue"></canvas>
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
                                    <h6 class="title">Dokumen Pemohon Dalam Proses Pengecekan</h6>
                                </div>
                                <a href="javascript:void(0)" {{-- wire:click.prevent="openModalForListData('tidak_ngukur')" --}}
                                    class="btn btn-sm btn-icon btn-trigger link-on-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Lihat Data">
                                    <em class="icon ni ni-focus"></em>
                                </a>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">
                                        {{ $this->getTotalPengajuanVerifikator('1') }}
                                        <span class="badge bg-warning">On-Checking</span>
                                    </div>
                                    <div class="nk-ecwg6-ck">
                                        <canvas class="ecommerce-line-chart-s3" id="todayCustomers"></canvas>
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
                                    <h6 class="title">Dokumen Pemohon Yang Sedang Dikoreksi</h6>
                                </div>
                                <a href="javascript:void(0)" {{-- wire:click.prevent="openModalForListData('tidak_ngukur')" --}}
                                    class="btn btn-sm btn-icon btn-trigger link-on-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Lihat Data">
                                    <em class="icon ni ni-focus"></em>
                                </a>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">
                                        {{ $this->getTotalPengajuanVerifikator('2') }}
                                        <span class="badge bg-danger">Need-Correction</span>
                                    </div>
                                    <div class="nk-ecwg6-ck">
                                        <canvas class="ecommerce-line-chart-s3" id="todayVisitors"></canvas>
                                    </div>
                                </div>
                                <div class="info"><em class="small"><small>Jumlah merupakan Pemohon Yang Sudah
                                            terdapat Log / Aktifitas Upload Dokumen</em></small></div>

                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div><!-- .col -->
        </div><!-- .row -->
        <div class="row gw">
            @php
                $dok_type_view = auth()->user()->type_validator;
            @endphp
            <div class="col-xxl-12">
                <livewire:data.table-upload-pemohon-verifikator :dok_status='0' :dok_type_view='$dok_type_view' />
            </div>
            <div class="col-xxl-12">
                <livewire:data.table-upload-pemohon-verifikator :dok_status='1' :dok_type_view='$dok_type_view' />
            </div>
            <div class="col-xxl-12">
                <livewire:data.table-upload-pemohon-verifikator :dok_status='2' :dok_type_view='$dok_type_view' />
            </div>
        </div>
    </div><!-- .nk-block -->
</div>
