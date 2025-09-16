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
                                        {{ $this->getTotalPemohon() }} <span class="bg-black badge round">Pemohon</span>
                                        |
                                        {{ $this->getTotalPemohonByStatus('4') }} <span
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
                                        {{ $this->getTotalPemohonByStatus('0') }}
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
                                        {{ $this->getTotalPemohonByStatus('1') }}
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
                                        {{ $this->getTotalPemohonByStatus('2') }}
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

            {{-- <div class="col-xxl-6">
                <div class="card card-full">
                    <div class="nk-ecwg nk-ecwg8 h-100">
                        <div class="card-inner">
                            <div class="mb-3 card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Statistic Pemohon PBG</h6>
                                </div>
                                <div class="card-tools">
                                    <div class="dropdown">
                                        <a href="#"
                                            class="dropdown-toggle link link-light link-sm dropdown-indicator"
                                            data-bs-toggle="dropdown">Weekly</a>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="#"><span>Daily</span></a></li>
                                                <li><a href="#" class="active"><span>Weekly</span></a></li>
                                                <li><a href="#"><span>Monthly</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="nk-ecwg8-legends">
                                <li>
                                    <div class="title">
                                        <span class="dot dot-lg sq" data-bg="#6576ff"></span>
                                        <span>PBG</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="title">
                                        <span class="dot dot-lg sq" data-bg="#eb6459"></span>
                                        <span>SLF</span>
                                    </div>
                                </li>
                            </ul>
                            <div class="nk-ecwg8-ck">
                                <canvas class="ecommerce-line-chart-s4" id="salesStatistics"></canvas>
                            </div>
                            <div class="chart-label-group ps-5">
                                <div class="chart-label">01 Jul, 2020</div>
                                <div class="chart-label">30 Jul, 2020</div>
                            </div>
                        </div><!-- .card-inner -->
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-xxl-3 col-md-6">
                <div class="overflow-hidden card card-full">
                    <div class="nk-ecwg nk-ecwg7 h-100">
                        <div class="card-inner flex-grow-1">
                            <div class="mb-4 card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Status Pengajuan</h6>
                                </div>
                            </div>
                            <div class="nk-ecwg7-ck">
                                <canvas class="ecommerce-doughnut-s1" id="orderStatistics"></canvas>
                            </div>
                            <ul class="nk-ecwg7-legends">
                                <li>
                                    <div class="title">
                                        <span class="dot dot-lg sq" data-bg="#816bff"></span>
                                        <span>Completed</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="title">
                                        <span class="dot dot-lg sq" data-bg="#13c9f2"></span>
                                        <span>Processing</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="title">
                                        <span class="dot dot-lg sq" data-bg="#ff82b7"></span>
                                        <span>Cancelled</span>
                                    </div>
                                </li>
                            </ul>
                        </div><!-- .card-inner -->
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-xxl-3 col-md-6">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="mb-2 card-title-group">
                            <div class="card-title">
                                <h6 class="title">Data Master</h6>
                            </div>
                        </div>
                        <ul class="nk-store-statistics">
                            <li class="item">
                                <div class="info">
                                    <div class="title">Total Pemohon</div>
                                    <div class="count">1</div>
                                </div>
                                <em class="icon bg-primary-dim ni ni-bag"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Petugas Verifikator TPA/TPT</div>
                                    <div class="count">5</div>
                                </div>
                                <em class="icon bg-info-dim ni ni-users"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Petugas Pengawas</div>
                                    <div class="count">2</div>
                                </div>
                                <em class="icon bg-pink-dim ni ni-box"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Categories</div>
                                    <div class="count">68</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                        </ul>
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .col --> --}}
        </div><!-- .row -->
        <div class="row gw">
            <div class="col-xxl-12">
                <livewire:data.table-pemohon-list />
            </div>
            <div class="col-xxl-12">
                <livewire:data.table-kinerja-verifikator />
            </div>
        </div>
    </div><!-- .nk-block -->
</div>

@push('scripts')
    <script src="{{ asset('js/charts/chart-ecommerce.js') }}"></script>
@endpush
