<div class="card card-stretch">
    <div class="card-inner-group">
        <div class="card-inner">
            <div class="card-title-group">
                <div class="card-title">
                    <h5 class="title">Informasi Penanganan Upload Berkas Pemohon</h5>
                    <p>Anda Mempunyai total 3 Berkas yang harus melalui proses
                        Validasi sebelum diupload ke <a href="https://simbg.pu.go.id/"
                            target="_blank">https://simbg.pu.go.id/</a> </p>
                </div>
                <div class="card-tools me-n1">
                    <ul class="btn-toolbar">
                        <li>
                            <a href="javascript:void(0)" class="btn btn-icon search-toggle toggle-search"
                                data-target="search"><em class="icon ni ni-search"></em></a>
                        </li><!-- li -->
                        <li class="btn-toolbar-sep"></li><!-- li -->
                        <li>
                            <div class="dropdown">
                                <a href="javascript:void(0)" class="btn btn-trigger btn-icon dropdown-toggle"
                                    data-bs-toggle="dropdown">
                                    <em class="icon ni ni-setting"></em>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                    <ul class="link-check">
                                        <li><span>Show</span></li>
                                        <li class="active"><a href="javascript:void(0)">10</a></li>
                                        <li><a href="javascript:void(0)">20</a></li>
                                        <li><a href="javascript:void(0)">50</a></li>
                                    </ul>
                                    <ul class="link-check">
                                        <li><span>Order</span></li>
                                        <li class="active"><a href="javascript:void(0)">DESC</a></li>
                                        <li><a href="javascript:void(0)">ASC</a></li>
                                    </ul>
                                    <ul class="link-check">
                                        <li><span>Density</span></li>
                                        <li class="active"><a href="javascript:void(0)">Regular</a></li>
                                        <li><a href="javascript:void(0)">Compact</a></li>
                                    </ul>
                                </div>
                            </div><!-- .dropdown -->
                        </li><!-- li -->
                    </ul><!-- .btn-toolbar -->
                </div><!-- card-tools -->
                <div class="card-search search-wrap" data-search="search">
                    <div class="search-content">
                        <a href="javascript:void(0)" class="search-back btn btn-icon toggle-search"
                            data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                        <input type="text" class="border-transparent form-control form-control-sm form-focus-none"
                            placeholder="Quick search by order id">
                        <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                    </div>
                </div><!-- card-search -->
            </div><!-- .card-title-group -->
        </div><!-- .card-inner -->
        <div class="p-0 card-inner table-responsive">
            <table class="table table-orders">
                <thead class="tb-odr-head">
                    <tr class="tb-odr-item">
                        <th class="tb-odr-info">
                            <span class="tb-odr-id">Dokumen ID</span>
                            <span class="tb-odr-date d-none d-md-inline-block">Date Upload & Dokumen Type </span>
                        </th>
                        <th class="tb-odr-amount">
                            <span class="tb-odr-total">Status</span>
                            <span class="tb-odr-status d-none d-md-inline-block">Keterangan</span>
                        </th>
                        <th class="tb-odr-action">&nbsp;</th>
                    </tr>
                </thead>
                <tbody class="tb-odr-body">
                    @foreach ($data as $i)
                        <tr class="tb-odr-item">
                            <td class="tb-odr-info">
                                <span class="tb-odr-id"><a
                                        href="{{ route('pengajuan.detail.upload', ['dokId' => $i->type_dokumen->id, 'id' => Crypt::encrypt($this->ids)]) }}">#{{ $i->id }}</a></span>
                                <span class="tb-odr-date">
                                    <small>
                                        <a
                                        href="{{ route('pengajuan.detail.upload', ['dokId' => $i->type_dokumen->id, 'id' => Crypt::encrypt($this->ids)]) }}"
                                            class="badge {{ config('styles.dokumen.' . $i->dokumen_type_id . '.class') }} link-white">
                                            {{ $i->type_dokumen->nama_dokumen }}
                                        </a>
                                        <span
                                            class="badge badge-dim {{ config('styles.dokumen.' . $i->dokumen_type_id . '.class') }}">
                                            {{ Carbon::parse($i->created_at)->format('d M Y, h:ia') }}
                                        </span>
                                    </small>
                                </span>
                            </td>
                            <td class="tb-odr-amount">
                                <span class="tb-odr-total">
                                    <span
                                        class="badge badge-dot {{ config('styles.status_upload.' . $i->status . '.class') }} badge-dim">{{ config('styles.status_upload.' . $i->status . '.text') }}</span>
                                </span>
                                <span class="tb-odr-status">
                                    <small>
                                        <div class="badge badge-dim {{ $i->keterangan ? 'bg-danger' : 'bg-info' }}">
                                            <span
                                                class="p-2 text-left amount text-wrap text-secondary text-decoration-underline text-small">
                                                {{ $i->keterangan ?? '-' }}
                                            </span>

                                        </div>
                                    </small>
                                </span>
                            </td>
                            <td class="tb-odr-action">
                                <div class="tb-odr-btns d-none d-sm-inline">
                                    <a href="javascript:void(0)"
                                        class="btn btn-sm btn-icon btn-trigger {{ config('styles.dokumen.' . $i->dokumen_type_id . '.class') }} link-white btn-auto round-sm"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        wire:click="downloadMedia('{{ $i->id }}','{{ $i->type_dokumen->nama_file }}')"
                                        title="Download {{ $i->type_dokumen->nama_dokumen }}">
                                        <em class="text-white icon ni ni-file-code-fill"></em>
                                    </a>
                                </div>
                                <div class="tb-odr-btns d-none d-sm-inline">
                                    <a href="{{ route('pengajuan.detail.upload', ['dokId' => $i->type_dokumen->id, 'id' => Crypt::encrypt($i->pengajuan->id)]) }}"
                                        class="btn btn-dim btn-sm btn-primary">Detail</a>
                                </div>
                                <a href="{{ route('pengajuan.detail.upload', ['dokId' => $i->type_dokumen->id, 'id' => Crypt::encrypt($i->pengajuan->id)]) }}"
                                    class="btn btn-pd-auto d-sm-none"><em class="icon ni ni-chevron-right"></em></a>
                            </td>
                        </tr><!-- .tb-odr-item -->
                    @endforeach
                </tbody>
            </table>
            @if ($totalData == 0 && $totalData == null)
                <div class="text-center border-top">
                    <a href="javascript:void(0)" class="btn btn-link btn-block">Anda Belum Mengupload Dokumen Terkait,
                        <br> Silahkan Upload Dokumen untuk proses Percepatan Pemeriksaan Dalam Hal Pengajuan PBG</a>
                </div>
            @endif
        </div><!-- .card-inner -->
        <div class="card-inner">
            <div class="row gy-4">
                <!-- Keterangan Status Verifikasi -->
                <div class="col-lg-6">
                    <h6 class="text-uppercase fw-bold center">Keterangan Status Dokumen</h6>
                    <div class="table-responsive">
                        <table class="table align-middle table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">Status</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center text-primary">
                                        <i class="ni ni-minus-circle-fill"></i> <strong>On-Waiting</strong>
                                    </td>
                                    <td>Dokumen Diteruskan kepada TPA / TPT</td>
                                </tr>
                                <tr>
                                    <td class="text-center text-info">
                                        <i class="ni ni-minus-circle-fill"></i> <strong>On-Checking</strong>
                                    </td>
                                    <td>Menunggu proses pengecekan TPA / TPT</td>
                                </tr>
                                <tr>
                                    <td class="text-center text-warning">
                                        <i class="ni ni-report-fill"></i> <strong>Need-Correction</strong>
                                    </td>
                                    <td>Dokumen Memerlukan revisi di wajibkan untuk mengupload ulang hasil koreksi dalam
                                        waktu yang ditentukan jika tidak pengajuan dianggap batal</td>
                                </tr>
                                <tr>
                                    <td class="text-center text-success">
                                        <i class="ni ni-check-circle-fill"></i> <strong>Complete</strong>
                                    </td>
                                    <td>Dokumen telah disetujui, Menunggu semua dokumen disetujui agar dapat mendownload
                                        BA yang diperlukan</td>
                                </tr>
                                {{-- <tr>
                                    <td class="text-center text-danger">
                                        <i class="ni ni-cross-circle-fill"></i> <strong>Ditolak</strong>
                                    </td>
                                    <td>Pengajuan ditolak dikarenakan alasan tertentu dan akan otomatis dihapus
                                        dalam waktu 7 hari</td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Keterangan SK Pengesahan -->
                <div class="col-lg-6">
                    <h6 class="mb-3 text-center text-uppercase fw-bold">Keterangan &amp; Ketentuan</h6>
                    <p>
                        <i class="bi bi-dot"></i> Berita Acara Akan diterbitkan apabila semua dokumen sudah
                        <span class="fw-bold text-success">Terverifikasi</span> oleh semua Stakeholder
                        ( Tim Ahli [TPA/TPT] & Pengawas ).
                    </p>
                    <p>
                        <button class="btn btn-primary btn-block" disabled>Download Berita Acara</button>
                    </p>
                    <hr>

                    <h6 class="mb-3 text-center text-uppercase fw-bold">Jam Pelayanan</h6>
                    <div class="p-3 rounded shadow-sm bg-light">
                        <p class="mb-2 text-center fw-semibold">SENIN - RABU</p>
                        <p class="mb-3 text-center">PUKUL <span class="fw-bold">07.30 - 16.00 WIB</span></p>

                        <p class="mb-2 text-center fw-semibold">KAMIS - JUM'AT</p>
                        <p class="text-center">PUKUL <span class="fw-bold">07.30 - 16.30 WIB</span></p>
                    </div>
                </div>

            </div>
        </div>
        {{-- <div class="card-inner">
            <ul class="pagination justify-content-center justify-content-md-start">
                <li class="page-item"><a class="page-link" href="javascript:void(0)">Prev</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0)">1</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                <li class="page-item"><span class="page-link"><em class="icon ni ni-more-h"></em></span></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0)">6</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0)">7</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0)">Next</a></li>
            </ul><!-- .pagination -->
        </div><!-- .card-inner --> --}}
    </div><!-- .card-inner-group -->
</div><!-- .card -->
