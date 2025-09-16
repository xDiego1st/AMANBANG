<div>
    <div class="progress" wire:ignore>
        <div wire:loading class="bg-success progress-bar progress-bar-striped progress-bar-animated" data-progress="100">
        </div>
    </div>
    <div class="card card-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">
                            Daftar Pengajuan Bangunan PBG Anda
                        </h3>
                        <span class="badge bg-outline-danger badge-dim text-wrap"> Data Yang Diajukan Hanyalah Data
                            Bangunan yang
                            akan diajukan di-SIMBG</span>
                        <hr>
                        <div class="nk-block-des text-soft d-none d-md-inline-flex">
                            <ul class="breadcrumb breadcrumb-pipe">
                                <li class="breadcrumb-item active">
                                    Terdapat Total {{ $totalData }} Data Dalam Proses
                                    <a wire:click.prevent="resetFilter" href="javascript:void(0)">
                                        <span class="cursor-pointer badge bg-secondary link-on-success"> Ditemukan
                                            ({{ $totalData }})
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="javascript:void(0)" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li class="nk-block-tools-opt">
                                        <btn data-bs-toggle="modal" class="btn btn-icon btn-primary d-md-none"><em
                                                class="icon ni ni-plus"></em></btn>
                                        <btn wire:click="$dispatch('modal-pengajuan-bangunan-pemohon')"
                                            {{-- wire:click="$dispatch('NIK-INTERVENSI', { nik: {{ $e->nik }} })" --}}
                                            class="btn btn-outline-primary btn-dim d-none d-md-inline-flex"><em
                                                class="icon ni ni-plus"></em><span>Pengajuan Bangunan Baru</span></btn>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .toggle-wrap -->
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->
            <div class="nk-block">
                <div class="card card-stretch card-bordered">
                    <div class="card-inner-group">
                        <div class="card-inner position-relative card-tools-toggle">
                            <div class="card-title-group">
                                <div class="card-tools">
                                    <div class="form-inline flex-nowrap gx-3">
                                        <div class="form-wrap w-150px" wire:ignore>
                                            <select class="form-select js-select2" data-search="on"
                                                data-placeholder="Bulk Action" id="{{ $uniqueId }}_sb"
                                                onchange="return setSelectBox('{{ $uniqueId }}_sb','bulkAction');">
                                                <option value="">Bulk Action</option>
                                                <option value="delete">Hapus Data</option>
                                            </select>
                                        </div>
                                        <div class="btn-wrap">
                                            <span class="d-none d-md-block"><button
                                                    class="btn btn-dim btn-outline-light"
                                                    wire:click='bulkButton'>Apply</button></span>
                                            <span class="d-md-none"><button
                                                    class="btn btn-dim btn-outline-light btn-icon disabled"><em
                                                        class="icon ni ni-arrow-right"></em></button></span>
                                        </div>
                                    </div><!-- .form-inline -->
                                </div><!-- .card-tools -->
                                <div class="card-tools me-n1">
                                    <ul class="btn-toolbar gx-1">
                                        <li>
                                            <a href="javascript:void(0)"
                                                class="btn btn-icon search-toggle toggle-search"
                                                data-target="search-{{ $uniqueId }}"><em
                                                    class="icon ni ni-search text-primary"></em></a>
                                        </li><!-- li -->
                                        <li class="btn-toolbar-sep"></li><!-- li -->
                                        <li>
                                            <div class="toggle-wrap">
                                                <a href="javascript:void(0)" class="btn btn-icon btn-trigger toggle"
                                                    data-target="cardTools-{{ $uniqueId }}"><em
                                                        class="icon ni ni-menu-right"></em></a>
                                                <div class="toggle-content"
                                                    data-content="cardTools-{{ $uniqueId }}">
                                                    <ul class="btn-toolbar gx-1">
                                                        <li class="toggle-close">
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-icon btn-trigger toggle"
                                                                data-target="cardTools-{{ $uniqueId }}"><em
                                                                    class="icon ni ni-arrow-left"></em></a>
                                                        </li><!-- li -->
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-trigger btn-icon dropdown-toggle"
                                                                    data-bs-toggle="dropdown">
                                                                    <div class="dot dot-primary"></div>
                                                                    <em class="icon ni ni-filter-alt text-warning"></em>
                                                                </a>
                                                                <div class="filter-wg dropdown-menu dropdown-menu-xl dropdown-menu-end"
                                                                    wire:ignore.self>
                                                                    <div class="dropdown-head">
                                                                        <span
                                                                            class="sub-title dropdown-title">Filter</span>
                                                                    </div>
                                                                    {{-- <div class="dropdown-body dropdown-body-rg">
                                                                        <div class="row gx-6 gy-3">
                                                                            <div class="col-12">
                                                                                <x-custom.forms.select2-pluck
                                                                                    model="f_kecamatan"
                                                                                    label="Kecamatan"
                                                                                    data="kecamatans"
                                                                                    labelDetail="Select Kecamatan"
                                                                                    viewLabel="true" />
                                                                            </div>
                                                                        </div>
                                                                    </div> --}}
                                                                    <div class="dropdown-foot center">
                                                                        <button wire:click="resetFilter"
                                                                            class="btn btn-outline-primary">Reset</button>
                                                                    </div>
                                                                </div><!-- .filter-wg -->
                                                            </div><!-- .dropdown -->
                                                        </li><!-- li -->
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-trigger btn-icon dropdown-toggle"
                                                                    data-bs-toggle="dropdown">
                                                                    <em class="icon ni ni-setting text-info"></em>
                                                                </a>
                                                                <x-custom.table.show-dropdown />
                                                            </div><!-- .dropdown -->
                                                        </li><!-- li -->
                                                    </ul><!-- .btn-toolbar -->
                                                </div><!-- .toggle-content -->
                                            </div><!-- .toggle-wrap -->
                                        </li><!-- li -->
                                    </ul><!-- .btn-toolbar -->
                                </div><!-- .card-tools -->
                            </div><!-- .card-title-group -->
                            <div class="card-search search-wrap" data-search="search-{{ $uniqueId }}"
                                wire:ignore.self>
                                <div class="card-body">
                                    <div class="search-content">
                                        <a href="javascript:void(0)" class="search-back btn btn-icon toggle-search"
                                            data-target="search-{{ $uniqueId }}"><em
                                                class="icon ni ni-arrow-left"></em></a>
                                        <input wire:model.live.debounce.150ms="textSearch" type="text"
                                            class="border-transparent form-control form-focus-none"
                                            placeholder="Ketik Kata Kunci Pencarian">
                                        <button class="search-submit btn btn-icon"><em
                                                class="icon ni ni-search"></em></button>
                                    </div>
                                </div>
                            </div><!-- .card-search -->
                        </div><!-- .card-inner -->
                        <div class="p-0 card-inner table-responsive">
                            <div class="nk-tb-list nk-tb-ulist is-separate table-responsive">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col nk-tb-col-check" wire:ignore>
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input"
                                                id="uid-all-{{ $uniqueId }}" wire:model.live='selectAll'
                                                wire:click.prevent='selectAlls'>
                                            <label class="custom-control-label"
                                                for="uid-all-{{ $uniqueId }}"></label>
                                        </div>
                                    </div>
                                    <div class="nk-tb-col"><span>Tgl Pengajuan</span></div>
                                    {{-- <div class="nk-tb-col"><span>Nama Bangunan</span></div> --}}
                                    <div class="nk-tb-col"><span class="sub-text">Nama Bangunan & No.Simbg</span>
                                    </div>
                                    <div class="nk-tb-col"><span>Jenis Bangunan</span></div>
                                    @foreach ($this->DokumenPemohon() as $i)
                                        <div class="nk-tb-col"><span>{{ $i->nama_dokumen }}</span></div>
                                    @endforeach
                                    <div class="nk-tb-col">Status Pengajuan</div>
                                    <div class="nk-tb-col nk-tb-col-tools">
                                        <ul class="nk-tb-actions gx-1 my-n1">
                                            <li>
                                                <div class="drodown">
                                                    <a href="javascript:void(0)"
                                                        class="dropdown-toggle btn btn-icon btn-trigger me-n1"
                                                        data-bs-toggle="dropdown"><em
                                                            class="icon ni ni-caution-fill"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li>
                                                                <a href="javascript:void(0)">
                                                                    <em
                                                                        class="icon ni ni-filter-fill text-info"></em><span>-</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                @foreach ($data as $key => $i)
                                    <div class="nk-tb-item" wire:key="{{ $i->id }}">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="uid{{ $i->id }}-{{ $uniqueId }}"
                                                    wire:model.live="selected" value="{{ $i->id }}">
                                                <label class="custom-control-label"
                                                    for="uid{{ $i->id }}-{{ $uniqueId }}"></label>
                                            </div>
                                            <div class="text-primary">
                                                #{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                                            </div>
                                        </div>
                                        <div class="nk-tb-col">
                                            <small class="tb-amount-sub">
                                                <a href="javascript:void(0)">{{ convert_date2($i->tgl_pengajuan) }}
                                                    <br>
                                                    <small><small>{{ convert_date($i->tgl_pengajuan) }}</small></small>
                                                </a></small>
                                        </div>
                                        <div class="nk-tb-col">
                                            <div class="user-card">
                                                <div class="user-info">
                                                    <span class="link-on-info link-success">{{ $i->nama_bangunan }}
                                                        <span class="dot dot-success d-md-none ms-1"></span></span>
                                                    <br>
                                                    <small
                                                        class="text-primary">#{{ $i->nomor_registrasi_simbg }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span
                                                class="badge {{ $i->jenis_pengajuan == 'PBG' ? 'bg-warning' : 'bg-primary' }}">{{ $i->jenis_pengajuan }}</span>
                                        </div>
                                        @foreach ($this->DokumenPemohon() as $dokp)
                                            @php
                                                $latestDokumenUser = $this->loadStatusDokumenPemohonTerbaru(
                                                    $i->user_id,
                                                    $dokp->id,
                                                    $i->detail_id,
                                                );
                                            @endphp
                                            <div class="nk-tb-col">
                                                @if (isset($latestDokumenUser))
                                                    <span
                                                        class="badge {{ config('styles.status_upload.' . $latestDokumenUser->status . '.class') }}">{{ config('styles.status_upload.' . $latestDokumenUser->status . '.text') }}</span>
                                                    @if ($latestDokumenUser->status == '3')
                                                        <br>
                                                       <small><small> Terverifikasi Pada
                                                        {{ convert_date2($latestDokumenUser->updated_at) }}</small></small>
                                                    @endif
                                                @else
                                                    @if ($i->status == '0' && $i->jenis_pengajuan == 'PBG')
                                                        <span class="badge badge-dim bg-outline-secondary">Menunggu
                                                            KRK</span>
                                                    @else
                                                        <a class="badge badge-dim bg-outline-danger"
                                                            href="{{ route('pemohon.pengajuan.dashboard.upload', ['id' => Crypt::encrypt($i->detail_id)]) }}">Dokumen
                                                            Belum Di-Upload
                                                            <em class="icon ni ni-file-download"></em>
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>
                                        @endforeach
                                        <div class="nk-tb-col">
                                            <span
                                                class="badge {{ config('styles.status_pemohon.' . $i->status . '.class') }}">{{ config('styles.status_pemohon.' . $i->status . '.text') }}</span>
                                        </div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-2">

                                                {{-- KRK --}}
                                                @if ($i->status >= 1 && $i->jenis_pengajuan == 'PBG')
                                                    <li class=" nk-tb-action-hidden bg-success-dim">
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-sm btn-icon btn-trigger bg-danger btn-outline-danger link-white btn-auto round-sm"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            wire:click="downloadMedia('{{ encrypt($i->detail_id) }}', 'krk')"
                                                            title="Download KRK">
                                                            <em class="text-white icon ni ni-file-code-fill"></em>
                                                        </a>
                                                    </li>
                                                @endif
                                                {{-- Selesai --}}
                                                @if ($i->status == 3)
                                                    <li class=" nk-tb-action-hidden bg-success-dim">
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-sm btn-icon btn-trigger bg-success btn-outline-danger link-white btn-auto round-sm"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            wire:click="downloadBA('{{ encrypt($i->id) }}')"
                                                            title="Lihat Berita Acara">
                                                            <em class="text-white icon ni ni-file-code-fill"></em>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if ($i->status >= 1)
                                                    <li class=" nk-tb-action-hidden bg-success-dim">
                                                        <a href="{{ route('pemohon.pengajuan.dashboard.upload', ['id' => Crypt::encrypt($i->detail_id)]) }}"
                                                            class="btn btn-sm btn-icon btn-trigger bg-primary btn-outline-danger link-white btn-auto round-sm"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Lanjutkan">
                                                            <em class="text-white icon ni ni-arrow-to-right"></em>
                                                        </a>
                                                    </li>
                                                @endif
                                                <li>
                                                    <div class="drodown">
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-sm btn-icon btn-trigger dropdown-toggle"
                                                            data-bs-toggle="dropdown"><em
                                                                class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                {{-- <li><a href="{{ route('pemohon.pengajuan.dashboard.upload', ['id' => Crypt::encrypt($i->detail_id)]) }}"><em
                                                                            class="icon ni ni-eye"></em><span>View
                                                                            Details</span></a></li> --}}
                                                                <li><a href="javascript:void(0)"
                                                                        wire:click.prevent="$dispatch('modal-pengajuan-bangunan-pemohon', { ids: {{ $i->detail_id }} })"><em
                                                                            class="icon ni ni-edit-fill"></em><span>Edit
                                                                            Data Pengajuan</span></a></li>
                                                                <li><a href="javascript:void(0)"
                                                                        wire:click.prevent="openModalAsk('Delete',{{ $i->id }})"><em
                                                                            class="icon ni ni-trash-empty"></em><span>Hapus
                                                                            Pengajuan</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- .nk-tb-item -->
                                @endforeach
                            </div><!-- .nk-tb-list -->
                        </div><!-- .card-inner -->
                        @if ($data->count() == 0)
                            <div class="text-center border-top">
                                <a href="javascript:void(0)" class="btn btn-link btn-block">Data Tidak Tersedia /
                                    Tidak
                                    Ditemukan</a>
                            </div>
                        @endif
                        <div class="card-inner table-responsive">
                            {{ $data->links('layouts.pagination-links') }}
                        </div><!-- .card-inner -->
                    </div><!-- .card-inner-group -->

                    <div class="card-inner">
                        <div class="row gy-4">
                            <!-- Keterangan Status Verifikasi -->
                            <div class="col-lg-6">
                                <h6 class="text-uppercase fw-bold center">Keterangan Status Pengajuan</h6>
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
                                                    <i class="ni ni-minus-circle-fill"></i> <strong>Diajukan</strong>
                                                </td>
                                                <td>Pengajuan Telah Diteruskan , Menunggu <span class="text-primary">3 (Tiga)
                                                        Hari Kerja</span> untuk di konfirmasi, Anda akan menerima
                                                    notifikasi apabila KRK (PBG) telah diterbitkan melalui WA yang
                                                    tercantum sesuai dengan informasi akun Anda</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center text-info">
                                                    <i class="ni ni-minus-circle-fill"></i>
                                                    <strong>On-Checking</strong>
                                                </td>
                                                <td>Menunggu proses pengecekan TPA / TPT</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center text-warning">
                                                    <i class="ni ni-report-fill"></i> <strong>Need-Correction</strong>
                                                </td>
                                                <td>Dokumen Memerlukan revisi di wajibkan untuk mengupload ulang hasil
                                                    koreksi dalam waktu yang ditentukan jika tidak pengajuan dianggap
                                                    batal</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center text-success">
                                                    <i class="ni ni-check-circle-fill"></i> <strong>Complete</strong>
                                                </td>
                                                <td>Dokumen telah disetujui, Menunggu semua dokumen disetujui agar dapat
                                                    mendownload BA yang diperlukan</td>
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
                                <hr>

                                <h6 class="mb-3 text-center text-uppercase fw-bold">Jam Pelayanan</h6>
                                <div class="p-3 rounded shadow-sm bg-light">
                                    <p class="mb-2 text-center fw-semibold">SENIN - RABU</p>
                                    <p class="mb-3 text-center">PUKUL <span class="fw-bold">07.30 - 16.00 WIB</span>
                                    </p>

                                    <p class="mb-2 text-center fw-semibold">KAMIS - JUM'AT</p>
                                    <p class="text-center">PUKUL <span class="fw-bold">07.30 - 16.30 WIB</span></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div><!-- .card -->

                <div wire:loading wire:target="exportData">
                    <div class="loading-overlay" wire:ignore>
                        <div class="loading-icon">&#9696;</div>
                        <div class="loading-message">Proses Export...</div>
                    </div>
                </div>
            </div><!-- .nk-block -->
            <div wire:loading wire:target="exportData">
                <div class="loading-overlay" wire:ignore>
                    <div class="loading-icon">&#9696;</div>
                    <div class="loading-message">Proses Export...</div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODALS --}}
    @livewire('modals.modal-pemohon-create-edit')
    @livewire('modals.modal-send-message-w-a')
</div>
