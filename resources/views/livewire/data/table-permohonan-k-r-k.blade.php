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
                            <small>
                                Daftar Pengajuan
                                {{ $f_jenis_pengajuan == 'PBG' ? 'PBG' : ($f_jenis_pengajuan == 'SLF' ? 'SLF' : 'PBG') }}
                                @if ($type_view == '1')
                                    <span class ="badge bg-danger">Belum Terdata Penomoran Registrasi SIMBG</span>
                                @elseif($type_view == '2')
                                    <span class ="badge bg-success">Sudah Terdata Penomoran Registrasi SIMBG</span>
                                @elseif($type_view == '0')
                                    <span class ="badge bg-warning">Yang Memerlukan Penerbitan KRK / Konfirmasi</span>
                                @else
                                    <span class ="badge bg-info">SEMUA</span>
                                @endif
                            </small>
                        </h3>
                        <small class="badge bg-outline-primary text-wrap badge-dim"> Data Yang Ditampilkan Hanyalah Data
                            Pemohon yang
                            sudah Mengajukan di aplikasi amanbang</small>
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
                    {{-- <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="javascript:void(0)" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li><a href="javascript:void(0)" class="btn btn-white btn-outline-light"><em
                                                class="icon ni ni-download-cloud"></em><span>Export</span></a></li>
                                    <li class="nk-block-tools-opt">
                                        <a href="#modalsPendataanPengajuanPemohon" data-bs-toggle="modal"
                                            class="btn btn-icon btn-primary d-md-none"><em
                                                class="icon ni ni-plus"></em></a>
                                        <a href="#modalsPendataanPengajuanPemohon" data-bs-toggle="modal"
                                            class="btn btn-outline-primary btn-dim d-none d-md-inline-flex"><em
                                                class="icon ni ni-plus"></em><span>Tambah Data Baru</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .toggle-wrap -->
                    </div> --}}
                    <!-- .nk-block-head-content -->
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
                                                <option value="wa">Send WA</option>
                                                <option value="delete">Hapus Data</option>
                                            </select>
                                        </div>
                                        <div class="btn-wrap">
                                            <span class="d-none d-md-block"><button
                                                    class="btn btn-dim btn-outline-primary"
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
                                        <button wire:click="$set('textSearch','')"
                                            class="search-back btn btn-icon toggle-search"
                                            data-target="search-{{ $uniqueId }}"><em
                                                class="icon ni ni-arrow-left"></em></button>
                                        <input wire:model.live.debounce.150ms="textSearch" type="text"
                                            class="border-transparent form-control form-focus-none"
                                            placeholder="Ketik Kata Kunci Pencarian">
                                        <button class="search-submit btn btn-icon"><em
                                                class="icon ni ni-search"></em></button>
                                    </div>
                                </div>
                            </div><!-- .card-search -->
                        </div><!-- .card-inner -->
                        <div class="p-0 card-inner table-responsive is-separate table-bordered is-compact">
                            <div class="nk-tb-list nk-tb-ulist">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col nk-tb-col-check" wire:ignore>
                                        <div class="custom-control custom-control-sm custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                id="uid-all-{{ $uniqueId }}" wire:model.live='selectAll'
                                                wire:click.prevent='selectAlls'>
                                            <label class="custom-control-label"
                                                for="uid-all-{{ $uniqueId }}"></label>
                                        </div>
                                    </div>
                                    <div class="nk-tb-col" style="min-width: 220px"><span>Tgl
                                            Pengajuan</span></div>
                                    @if ($type_view != '0')
                                        <div class="nk-tb-col" style="min-width: 140px;"><span>Nomor Pengajuan
                                                SIMBG</span></div>
                                    @endif

                                    <div class="nk-tb-col tb-col-lg" style="width: 8px"><span>Kontak Pemohon</span>
                                    </div>
                                    <div class="nk-tb-col"><span>Jenis Permohonan & Tim Penilai</span></div>
                                    <div class="nk-tb-col"><span>Nama Bangunan</span></div>
                                    <div class="nk-tb-col"><span>Luas Bangunan</span></div>
                                    <div class="nk-tb-col" style="min-width: 120px;"><span>File Pemohon </span>
                                    </div>
                                    @if (!$table_view == 'rekap' && $type_view != '2')
                                        <div class="nk-tb-col" style="min-width: 220px;"><span>Lokasi Bangunan</span>
                                        </div>
                                    @endif
                                    @if ($type_view != '0')
                                        <div class="nk-tb-col" style="min-width: 160px;"><span>Tim Ahli</span></div>
                                    @endif
                                    @if ($type_view == '0')
                                        <div class="nk-tb-col" style="min-width: 160px;"><span>Status</span></div>
                                        <div class="nk-tb-col" style="min-width: 160px;"><span>Keterangan</span></div>
                                    @endif
                                    <div class="nk-tb-col nk-tb-col-tools">
                                        <ul class="nk-tb-actions gx-1 my-n1">
                                            <li>
                                                <div class="drodown">
                                                    <a href="javascript:void(0)"
                                                        class="dropdown-toggle btn btn-icon btn-trigger me-n1"
                                                        data-bs-toggle="dropdown"><em
                                                            class="icon ni ni-caution-fill "></em></a>
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
                                            <div class="small text-primary">
                                                #{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                                            </div>
                                        </div>
                                        <div class="nk-tb-col">
                                            <small class="tb-amount-sm">{{ convert_date2($i->created_at) }}
                                                <br>
                                                {{ $i->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                        @if ($type_view != '0')
                                            <div class="nk-tb-col">
                                                <span
                                                    class="tb-amount-sub center">{{ $i->nomor_registrasi_simbg ?? 'Belum Terdaftar' }}</span>
                                            </div>
                                        @endif
                                        <div class="nk-tb-col tb-col-lg">
                                            <span
                                                class="badge badge-dot badge-dot-xs bg-info">{{ $i->nama }}</span>
                                            <span
                                                class="badge badge-dot badge-dot-xs bg-secondary">{{ $i->no_wa }}</span>
                                            <span
                                                class="badge badge-dot badge-dot-xs bg-secondary text-wrap">{{ $i->user->email }}</span>
                                        </div>

                                        <div class="nk-tb-col">
                                            <ul class="list-status gy-1">
                                                <li><em class="icon text-success ni ni-check-circle"></em> <span
                                                        class="badge bg-danger">{{ $i->jenis_pengajuan ?? '-' }}</span>
                                                </li>
                                                <li><em class="icon ni ni-alert-circle"></em> <span
                                                        class="badge badge-dim bg-outline-primary">{{ $i->team_penilai_ba ?? '-' }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="nk-tb-col">
                                            <small><small
                                                    class="text-info tb-amount-sm overline-title">{{ $i->nama_bangunan ?? '-' }}</small></small>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-amount-sm">{{ $i->luas_lahan . ' m2' ?? '-' }}</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            @if ($i->jenis_pengajuan == 'SLF')
                                                <span class="text-primary badge bg-info badge-dot"></span>
                                                <button class="btn btn-outline-info btn-sm btn-dim btn-block" disabled>
                                                    Tidak Memerlukan KRK
                                                </button>
                                            @else
                                                @php
                                                    $media = $i->getMedia('upload_syarat_krk');
                                                    $filekrk = $i->getMedia('krk');
                                                @endphp
                                                <button class="btn btn-primary btn-sm btn-dim btn-block"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#dokumenModal{{ $i->id }}">
                                                    <em class="icon ni ni-file-check-fill"></em>
                                                    File Permohonan
                                                </button>

                                                {{-- Modal untuk preview dokumen --}}
                                                <div class="modal fade" id="dokumenModal{{ $i->id }}"
                                                    tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Dokumen Persyaratan</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="text-center modal-body">
                                                                @foreach ($media as $file)
                                                                    @if (Str::endsWith($file->file_name, ['.jpg', '.jpeg', '.png']))
                                                                        <img src="{{ $file->getUrl() }}"
                                                                            class="mb-3 rounded img-fluid"
                                                                            alt="dokumen">
                                                                    @elseif (Str::endsWith($file->file_name, ['.pdf']))
                                                                        <iframe src="{{ $file->getUrl() }}"
                                                                            width="100%" height="600"
                                                                            style="border:0; border-radius:8px;"></iframe>
                                                                    @else
                                                                        <a href="{{ $file->getUrl() }}"
                                                                            target="_blank" class="btn btn-link">
                                                                            Download {{ $file->file_name }}
                                                                        </a>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($filekrk->count() > 0)
                                                    <hr>
                                                    <button class="btn btn-success btn-sm btn-dim btn-block"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#krkModal{{ $i->id }}">
                                                        <em class="icon ni ni-file-check-fill"></em>
                                                        File KRK
                                                    </button>

                                                    {{-- Modal untuk preview dokumen --}}
                                                    <div class="modal fade" id="krkModal{{ $i->id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Dokumen KRK Pemohon</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="text-center modal-body">
                                                                    @foreach ($filekrk as $file)
                                                                        @if (Str::endsWith($file->file_name, ['.jpg', '.jpeg', '.png']))
                                                                            <img src="{{ $file->getUrl() }}"
                                                                                class="mb-3 rounded img-fluid"
                                                                                alt="dokumen">
                                                                        @elseif (Str::endsWith($file->file_name, ['.pdf']))
                                                                            <iframe src="{{ $file->getUrl() }}"
                                                                                width="100%" height="600"
                                                                                style="border:0; border-radius:8px;"></iframe>
                                                                        @else
                                                                            <a href="{{ $file->getUrl() }}"
                                                                                target="_blank" class="btn btn-link">
                                                                                Download {{ $file->file_name }}
                                                                            </a>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <hr>
                                                    <span class="btn btn-danger btn-sm btn-dim btn-block">KRK Belum
                                                        diterbitkan</span>
                                                @endif
                                                @if ($i->status == '3')
                                                    <hr>
                                                    <button type="button"
                                                        class="btn btn-block btn-dim btn-sm btn-primary d-inline-flex align-items-center justify-content-center"
                                                        data-bs-toggle="modal" data-bs-target="#modalBaPreview"
                                                        data-src="{{ route('genarate.pdf.ba', ['idpengajuan' => Crypt::encrypt($i->id)]) }}"
                                                        title="Lihat Dokumen" style="min-height: 34px">
                                                        <em class="icon ni ni-file-docs"></em><span>File Berita
                                                            Acara</span>
                                                    </button>
                                                @else
                                                    <hr>
                                                    <span class="btn btn-danger btn-sm btn-dim btn-block">Berita Acara
                                                        Belum
                                                        diterbitkan</span>
                                                @endif
                                            @endif
                                        </div>

                                        @if (!$table_view == 'rekap' && $type_view != '2')
                                            <div class="nk-tb-col">
                                                @if ($i->koordinat_lokasi)
                                                    @php
                                                        $coords = explode(',', $i->koordinat_lokasi);
                                                        $lat = trim($coords[0] ?? 0);
                                                        $lng = trim($coords[1] ?? 0);
                                                    @endphp

                                                    {{-- Koordinat teks --}}
                                                    <span class="tb-amount-sm d-block">{{ $i->alamat }}</span>

                                                    {{-- Thumbnail Map kecil --}}
                                                    <div class="mt-1"
                                                        style="width: 100%; height: 80px; cursor: pointer;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#mapModal{{ $i->id }}">
                                                        <iframe width="100%" height="100%"
                                                            style="border:0; border-radius:6px; pointer-events: none;"
                                                            src="https://maps.google.com/maps?q={{ $lat }},{{ $lng }}&hl=id&z=14&output=embed">
                                                        </iframe>
                                                    </div>

                                                    {{-- Modal untuk Map besar --}}
                                                    <div class="modal fade" id="mapModal{{ $i->id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Lokasi pada Peta</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="p-0 modal-body">
                                                                    <iframe width="100%" height="450"
                                                                        style="border:0; border-radius:8px;"
                                                                        src="https://maps.google.com/maps?q={{ $lat }},{{ $lng }}&hl=id&z=16&output=embed"
                                                                        allowfullscreen loading="lazy">
                                                                    </iframe>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="tb-amount-sm">-</span>
                                                @endif
                                            </div>
                                        @endif

                                        @if ($type_view != '0')
                                            <div class="nk-tb-col">
                                                @php
                                                    // Ambil koleksi user (hindari null & duplikat)
                                                    $verifikatorUsers = collect($i->verifikators ?? [])
                                                        ->pluck('user')
                                                        ->filter()
                                                        ->unique('id')
                                                        ->values();
                                                    $pengawasUsers = collect($i->pengawas ?? [])
                                                        ->pluck('user')
                                                        ->filter()
                                                        ->unique('id')
                                                        ->values();

                                                    // Maksimal avatar yang ditampilkan; sisanya jadi "+N"
                                                    $maxShow = 5;

                                                    // Helper inisial (maks 2 huruf)
                                                    $initials = function ($name) {
                                                        $parts = preg_split('/\s+/', trim($name ?? ''));
                                                        $a = mb_substr($parts[0] ?? '', 0, 1);
                                                        $b = mb_substr($parts[1] ?? '', 0, 1);
                                                        $ini = strtoupper($a . $b);
                                                        return $ini !== '' ? $ini : 'NA';
                                                    };
                                                @endphp

                                                {{-- Verifikator --}}
                                                <div class="mb-1 text-soft small">Verifikator</div>
                                                <ul class="g-1 project-users" style="margin: 0.5rem 0;">
                                                    @forelse($verifikatorUsers->take($maxShow) as $u)
                                                        <li>
                                                            <div class="user-avatar sm {{ $u?->profile_photo_url ? '' : 'bg-primary' }}"
                                                                data-bs-toggle="tooltip" title="{{ $u?->name }}">
                                                                @if ($u?->profile_photo_url)
                                                                    {{-- Jetstream profile photo --}}
                                                                    <img src="{{ $u->profile_photo_url }}"
                                                                        alt="{{ $u->name }}"
                                                                        class="rounded-circle"
                                                                        style="width:30px;height:30px;object-fit:cover;">
                                                                @else
                                                                    <span>{{ $initials($u?->name) }}</span>
                                                                @endif
                                                            </div>
                                                        </li>
                                                    @empty
                                                        <li><span class="text-muted small">—</span></li>
                                                    @endforelse

                                                    @if ($verifikatorUsers->count() > $maxShow)
                                                        <li>
                                                            <div class="user-avatar sm bg-light"
                                                                data-bs-toggle="tooltip"
                                                                title="{{ $verifikatorUsers->slice($maxShow)->pluck('name')->join(', ') }}">
                                                                <span>+{{ $verifikatorUsers->count() - $maxShow }}</span>
                                                            </div>
                                                        </li>
                                                    @endif
                                                </ul>

                                                {{-- Pengawas --}}
                                                <div class="mt-2 mb-1 text-soft small">Pengawas</div>
                                                <ul class="g-1 project-users" style="margin: 0.5rem 0;">
                                                    @forelse($pengawasUsers->take($maxShow) as $u)
                                                        <li>
                                                            <div class="user-avatar sm {{ $u?->profile_photo_url ? '' : 'bg-blue' }}"
                                                                data-bs-toggle="tooltip" title="{{ $u?->name }}">
                                                                @if ($u?->profile_photo_url)
                                                                    {{-- Jetstream profile photo --}}
                                                                    <img src="{{ $u->profile_photo_url }}"
                                                                        alt="{{ $u->name }}"
                                                                        class="rounded-circle"
                                                                        style="width:30px;height:30px;object-fit:cover;">
                                                                @else
                                                                    <span>{{ $initials($u?->name) }}</span>
                                                                @endif
                                                            </div>
                                                        </li>
                                                    @empty
                                                        <li><span class="text-muted small">—</span></li>
                                                    @endforelse

                                                    @if ($pengawasUsers->count() > $maxShow)
                                                        <li>
                                                            <div class="user-avatar sm bg-light"
                                                                data-bs-toggle="tooltip"
                                                                title="{{ $pengawasUsers->slice($maxShow)->pluck('name')->join(', ') }}">
                                                                <span>+{{ $pengawasUsers->count() - $maxShow }}</span>
                                                            </div>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        @endif
                                        @php($sla = $this->slaInfo($i->created_at))


                                        @if ($type_view == '0')
                                            <div class="nk-tb-col">
                                                <span class="badge bg-danger">Belum Terverifikasi</span>
                                            </div>
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
                                            <ul class="nk-tb-actions gx-1">
                                                <li class="nk-tb-action-hidden">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#modalBaPreview"
                                                        data-src="{{ route('genarate.pdf.ba', ['idpengajuan' => Crypt::encrypt($i->id)]) }}"
                                                        class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" aria-label="Quick View"
                                                        data-bs-original-title="Preview BA">
                                                        <em class="icon ni ni-eye-fill text-dannger" ></em>
                                                    </a>
                                                </li>
                                                @if ($i->status == '0')
                                                    <li class="nk-tb-action-hidden">
                                                        <button wire:click="$dispatch('modal-upload-krk-pemohon',{ids:{{ $i->id }}})"
                                                            class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" aria-label="Approved"
                                                            data-bs-original-title="Approved">
                                                            <em class="icon ni ni-check-fill-c text-success"></em>
                                                        </button>
                                                    </li>
                                                    {{-- <li class="nk-tb-action-hidden">
                                                        <a href="#" class="btn btn-trigger btn-icon"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            aria-label="Rejected" data-bs-original-title="Rejected">
                                                            <em class="icon ni ni-cross-fill-c text-danger"></em>
                                                        </a>
                                                    </li> --}}
                                                @endif
                                                @if ($i->status == '1' && !$i->nomor_registrasi_simbg)
                                                    <li class="nk-tb-action-hidden">
                                                        <button wire:click="$dispatch('modal-upload-krk-pemohon',{ids:{{ $i->id }}})"
                                                            class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" aria-label="Approved"
                                                            data-bs-original-title="Approved">
                                                            <em class="icon ni ni-check-fill-c text-success"></em>
                                                        </button>
                                                    </li>
                                                    {{-- <li class="nk-tb-action-hidden">
                                                        <a href="#" class="btn btn-trigger btn-icon"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            aria-label="Rejected" data-bs-original-title="Rejected">
                                                            <em class="icon ni ni-cross-fill-c text-danger"></em>
                                                        </a>
                                                    </li> --}}
                                                @endif
                                                <li>
                                                    <div class="drodown">
                                                        <a href="#"
                                                            class="dropdown-toggle btn btn-icon btn-trigger"
                                                            data-bs-toggle="dropdown" aria-expanded="false"><em
                                                                class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="#"><em
                                                                            class="icon ni ni-focus text-info"></em><span
                                                                            class="text-info">Detail
                                                                            Pengajuan</span></a></li>
                                                                <li><a href="#"><em
                                                                            class="icon ni ni-whatsapp text-primary"></em><span
                                                                            class="text-primary">Send Message
                                                                            WA</span></a></li>
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
        </div>
    </div>

    <div wire:loading wire:target="exportData">
        <div class="loading-overlay" wire:ignore>
            <div class="loading-icon">&#9696;</div>
            <div class="loading-message">Proses Export...</div>
        </div>
    </div>
    {{-- Loading toast pojok kanan bawah saat Livewire loading --}}
    <x-custom.etc.loading-overlay text="Mengunggah berkas…" subtext="Jangan tutup halaman"
        target="submitDokumen, files_upload.*" position="bottom-right" />


    {{-- MODALS --}}
    @livewire('modals.modal-pemohon-create-edit')
    {{-- @livewire('modals.modal-upload-k-r-k-pemohon') --}}
    @livewire('modals.modal-upload-k-r-k-pemohon')
    {{-- <Livewire:modals.modal-upload-k-r-k-pemohon wire:key=''/> --}}
    {{-- Modal Fullscreen Preview BA (letakkan di akhir halaman) --}}
    <div class="modal fade" id="modalBaPreview" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Preview Dokumen Berita Acara
                    </h5>
                    <div class="gap-2 d-flex align-items-center">
                        {{-- Tombol buka di tab baru sebagai fallback --}}
                        <a id="baPreviewOpenNewTab" href="#" target="_blank"
                            class="btn btn-sm btn-outline-secondary">
                            <em class="icon ni ni-external"></em> Buka Tab Baru
                        </a>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Tutup"></button>
                    </div>
                </div>
                <div class="p-0 modal-body">
                    <div class="w-100 h-100 position-relative" style="min-height: 70vh;">
                        {{-- Skeleton ringan saat iframe load --}}
                        <div id="baPreviewLoader"
                            class="text-center position-absolute top-50 start-50 translate-middle">
                            <div class="spinner-border" role="status" aria-hidden="true"></div>
                            <div class="mt-2 small text-soft">Memuat dokumen...</div>
                        </div>
                        {{-- Iframe dokumen --}}
                        <iframe id="baPreviewFrame" src="" title="Preview BA" class="border-0 w-100 h-100"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalEl = document.getElementById('modalBaPreview');
            const frame = document.getElementById('baPreviewFrame');
            const loader = document.getElementById('baPreviewLoader');
            const openNewTab = document.getElementById('baPreviewOpenNewTab');

            // Saat tombol "Lihat" diklik, ambil data-src dan set ke iframe
            modalEl.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget; // tombol pemicu
                const src = button?.getAttribute('data-src') || '#';
                // tampilkan loader, kosongkan dulu iframe
                loader.style.display = 'block';
                frame.src = '';
                // set link "buka tab baru"
                openNewTab.href = src;
                // set iframe setelah sedikit delay agar transisi halus
                setTimeout(() => {
                    frame.src = src;
                }, 50);
            });

            // Sembunyikan loader saat iframe selesai load
            frame.addEventListener('load', function() {
                loader.style.display = 'none';
            });

            // Bersihkan iframe saat modal ditutup (hemat memori & hentikan render PDF)
            modalEl.addEventListener('hidden.bs.modal', function() {
                frame.src = '';
                openNewTab.href = '#';
                loader.style.display = 'block';
            });
        });
    </script>
@endpush
