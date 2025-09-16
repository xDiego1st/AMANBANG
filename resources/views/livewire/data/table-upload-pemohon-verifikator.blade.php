<div>
    <hr>
    @if ($totalData > 0 && $dok_status == '1')
        <div class="nk-block">
            <div class="example-alert card">
                <div class="alert alert-pro alert-danger alert-dismissible">
                    <div class="alert-text">
                        <h6>Informasi!</h6>
                        <p> <span class="text-decoration-underline">Anda Memiliki Total {{ $totalData }} Data Pemohon
                                Yang Sedang Dalam Proses Checking. </span>

                            <br> Maka Dari itu Anda Perlu Memberikan <span class="badge bg-danger">Keterangan /
                                Verifikasi</span>
                            <span class="text-bold text-decoration-underline"> Apakah
                                Dokumen Tersebut Sudah Sesuai atau belum
                            </span>
                            <hr>
                            <span class="text-success badge badge-dim bg-outline-info text-wrap">Dokumen Yang
                                Telah didiberikan Keterangan Tidak Akan Ditampilkan Kembali Dalam Table Data Dibawah Ini
                            </span>
                        </p>
                    </div>
                    <button class="close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        </div>
    @endif
    <div class="progress" wire:ignore>
        <div wire:loading class="bg-success progress-bar progress-bar-striped progress-bar-animated"
            data-progress="100"></div>
    </div>
    <div class="card card-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title text-wrap">
                            <small>Pengajuan Dokumen Pemohon PBG</small>
                            <span class="badge  {{ config('styles.keterangan_upload.' . $dok_status . '.class') }}">
                                {{ config('styles.keterangan_upload.' . $dok_status . '.text') }}
                            </span>
                            <span
                                class="badge  {{ config('styles.type_validator.' . $user->type_validator . '.class') }}">
                                {{ config('styles.type_validator.' . $user->type_validator . '.text') }}
                            </span>
                        </h3>
                        <small class="badge bg-outline-info text-wrap"> Data Yang Ditampilkan Hanyalah Data Pemohon yang
                            sudah
                            melakukan Upload Dokumen Sesuai Role Verifikator</small>
                        <hr>
                        <div class="nk-block-des text-soft d-none d-md-inline-flex">
                            <ul class="breadcrumb breadcrumb-pipe">
                                <li class="breadcrumb-item active">
                                    Terdapat Total {{ $totalData }} Data Dalam Proses
                                    <span
                                        class="badge  {{ config('styles.keterangan_upload.' . $dok_status . '.class') }}">
                                        {{ config('styles.keterangan_upload.' . $dok_status . '.text') }}
                                    </span>
                                    <a wire:click.prevent="resetFilter" href="javascript:void(0)">
                                        <span class="cursor-pointer badge bg-secondary link-on-success"> Ditemukan
                                            ({{ $totalData }})
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
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
                                                @if ($type_data)
                                                    <option value="Lepas Stunting">Lepas Stunting</option>
                                                    <option value="Pindah">Pindah</option>
                                                    <option value="Mati">Mati</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="btn-wrap">
                                            <span class="d-none d-md-block"><button
                                                    class="btn btn-dim btn-outline-light"
                                                    wire:click='bulkButton'>Apply</button>
                                                {{ $bulkAction }}</span>
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
                            <div class="nk-tb-list nk-tb-ulist is-compact table-responsive">
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
                                    <div class="nk-tb-col"><span class="sub-text">Nama / No.Wa</span></div>
                                    <div class="nk-tb-col"><span class="sub-text">Nomor Regis Simbg</span></div>
                                    <div class="nk-tb-col tb-col-md"><span class="sub-text">Nama Bangunan /
                                            Alamat</span></div>
                                    <div class="nk-tb-col tb-col-lg"><span class="sub-text">Kelurahan</span></div>
                                    <div class="nk-tb-col tb-col-lg"><span class="sub-text">Kecamatan</span></div>
                                    <div class="nk-tb-col tb-col-lg"><span class="sub-text">Jenis Pengajuan</span>
                                    </div>
                                    <div class="nk-tb-col" style="min-width: 280px"><span class="sub-text">Upload Ke-
                                            / Dokumen</span></div>
                                    <div class="nk-tb-col"><span class="sub-text">Status Dokumen</span></div>
                                    @if ($dok_status == '0')
                                        <div class="nk-tb-col"><span class="sub-text">Keterangan</span></div>
                                    @endif

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
                                @foreach ($data as $key => $e)
                                    <div class="nk-tb-item" wire:key="{{ $e->id }}">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="uid{{ $e->id }}-{{ $uniqueId }}"
                                                    wire:model.live="selected" value="{{ $e->id }}">
                                                <label class="custom-control-label"
                                                    for="uid{{ $e->id }}-{{ $uniqueId }}"></label>
                                            </div>
                                            <div class="small">
                                                #{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                                            </div>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span><a href="javascript:void(0)"
                                                    class="link-on-info link-success">{{ $e->pengajuan->nama }}</a></span>
                                            <br>
                                            <span class="small text-info">
                                                <span class="badge bg-info">WA</span>
                                                +{{ $e->pengajuan->no_wa }}</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="small">{{ $e->pengajuan->nomor_registrasi_simbg }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            <span class="small">{{ $e->pengajuan->nama_bangunan }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-lg">
                                            <span class="small">{{ $e->pengajuan->lokasi_bangunan_kelurahan }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-lg">
                                            <span class="small">{{ $e->pengajuan->lokasi_bangunan_Kecamatan }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-lg">
                                            <span
                                                class="small badge bg-danger">{{ $e->pengajuan->jenis_pengajuan }}</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            @if ($e->pengajuan->team_penilai_ba == 'TPA')
                                                @php
                                                    $latestdok = $e->pengajuan->LatestDokumenUser($dok_type_view);
                                                    $latestdokstatus = $latestdok?->status;
                                                    $jmlupload = $e->pengajuan->jumlahUploadDokumenUser($dok_type_view);
                                                @endphp
                                                @if ($jmlupload > 0)
                                                    <span class="small badge bg-primary">{{ $jmlupload }}
                                                        x</span>
                                                    <small>Di Upload Pada : {{ convert_date2($e->created_at) }} -
                                                        {{ $e->created_at->diffForhumans() }}</small>
                                                    <br>
                                                @else
                                                    <span class="small badge bg-danger">Pemohon Belum Mengupload</span>
                                                @endif
                                                <span
                                                    class="small badge {{ config('styles.dokumen.' . $dok_type_view . '.class') }}">{{ config('styles.dokumen.' . $dok_type_view . '.text') }}</span>
                                                <br>
                                            @else
                                                @foreach ($this->loadDokumen() as $ldok)
                                                    @php
                                                        $jmlupload = $e->pengajuan->jumlahUploadDokumenUser($ldok->id);
                                                    @endphp
                                                    <span class="badge bg-danger">{{ $jmlupload }}x</span>
                                                    <span
                                                        class="badge badge-dim {{ config('styles.dokumen.' . $ldok->id . '.class') }}">{{ $ldok->nama_dokumen }}</span>
                                                    <br>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="nk-tb-col">
                                            @if ($e->pengajuan->team_penilai_ba == 'TPA')
                                                <span
                                                    class="small badge {{ config('styles.status_upload.' . $latestdokstatus . '.class') }}">{{ config('styles.status_upload.' . $latestdokstatus . '.text') }}</span>
                                            @else
                                                @foreach ($this->loadDokumen() as $ldok)
                                                    @php
                                                        $latestdok = $e->pengajuan->LatestDokumenUser($ldok->id);
                                                        $latestdokstatus = $latestdok?->status;
                                                    @endphp
                                                    <span
                                                        class="small badge {{ config('styles.status_upload.' . $latestdokstatus . '.class') }}">{{ config('styles.status_upload.' . $latestdokstatus . '.text') }}</span>
                                                    <br>
                                                @endforeach
                                            @endif
                                        </div>
                                        @if ($dok_status == '0')
                                            @php($sla = $this->slaInfo($e->created_at))
                                            <div class="nk-tb-col">
                                                <span class="{{ $sla['badge'] }}">
                                                    <em class="icon ni {{ $sla['icon'] }} me-1"></em>
                                                    {{ $sla['text'] }}
                                                </span>
                                                <div class="mt-1 small text-muted">
                                                    Batas: {{ $sla['deadline'] }}
                                                </div>

                                                @if ($sla['late'])
                                                    <div class="px-2 py-1 mt-1 mb-0 alert alert-danger small">
                                                        <strong>Peringatan:</strong> {{ $sla['notice'] }}
                                                    </div>
                                                @elseif($sla['minutes_left'] <= 120)
                                                    <div class="px-2 py-1 mt-1 mb-0 alert alert-warning small">
                                                        <strong>Reminder:</strong> {{ $sla['notice'] }}
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-2">
                                                @if ($e->status_verifikator != '4')
                                                    <li class=" nk-tb-action-hidden bg-success-dim">
                                                        <a href="#modalsSendMessageWa" data-bs-toggle="modal"
                                                            wire:click="$dispatch('SelectedPemohon', { id: {{ $e->pengajuan->user->id }} })"
                                                            class="btn btn-sm btn-icon btn-trigger bg-success btn-outline-info link-white btn-auto round-sm"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Send Message">
                                                            <em class="text-white icon ni ni-whatsapp"></em>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if ($e->pengajuan->team_penilai_ba == 'TPA')
                                                    <li class=" nk-tb-action-hidden bg-success-dim">
                                                        <a href="{{ route('pengajuan.detail.upload', ['dokId' => $user->type_validator, 'id' => Crypt::encrypt($e->pengajuan->id)]) }}"
                                                            class="btn btn-sm btn-icon btn-trigger bg-success btn-outline-danger link-white btn-auto round-sm"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="View Detail">
                                                            <em class="text-white icon ni ni-focus"></em>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li class=" nk-tb-action-hidden bg-success-dim">
                                                        <a href="{{ route('verifikator.detail.upload.tpt', ['id' => Crypt::encrypt($e->pengajuan->id)]) }}"
                                                            class="btn btn-sm btn-icon btn-trigger bg-primary btn-outline-primary link-white btn-auto round-sm"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="View Detail">
                                                            <em class="text-white icon ni ni-focus"></em>
                                                        </a>
                                                    </li>
                                                @endif
                                                {{-- <li class=" nk-tb-action-hidden">
                                                    <a href="#modalsPendataanIntervensiStunting"
                                                        data-bs-toggle="modal"
                                                        wire:click="$dispatch('NIK-INTERVENSI', { nik: {{ $e->nik }} })"
                                                        class="btn btn-sm btn-icon btn-trigger bg-warning btn-outline-danger link-white btn-auto round-sm"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Input Intervensi">
                                                        <em class="text-white icon ni ni-note-add-fill"></em>
                                                    </a>
                                                </li> --}}
                                                <li>
                                                    <div class="drodown">
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-sm btn-icon btn-trigger dropdown-toggle"
                                                            data-bs-toggle="dropdown"><em
                                                                class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="javascript:void(0)"><em
                                                                            class="icon ni ni-eye"></em><span>View
                                                                            Details</span></a></li>
                                                                {{-- <li><a href="javascript:void(0)"
                                                                        wire:click.prevent="#"><em
                                                                            class="icon ni ni-trash"></em><span>Delete
                                                                            Data</span></a></li> --}}
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
                </div><!-- .card -->
            </div><!-- .nk-block -->
            <div wire:loading wire:target="exportData">
                <div class="loading-overlay" wire:ignore>
                    <div class="loading-icon">&#9696;</div>
                    <div class="loading-message">Proses Export...</div>
                </div>
            </div>
            @livewire('modals.modal-send-message-w-a')
        </div>
    </div>
</div>
