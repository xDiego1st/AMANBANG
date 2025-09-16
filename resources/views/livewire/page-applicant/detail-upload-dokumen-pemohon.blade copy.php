<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">{{ $dp->jenis_pengajuan ?? '-' }} / <strong
                        class="text-primary small">{{ $dp->nama ?? '-' }}</strong>
                </h3>
                <div class="nk-block-des text-soft">
                    <ul class="list-inline">
                        <li>Application ID: <span class="text-base">{{ $dp?->nomor_registrasi_simbg }}</span></li>
                        <li>Since At: <span
                                class="text-base">{{ Carbon::parse($dp->created_at)->isoFormat('dddd | D MMMM Y, h:mm a') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="nk-block-head-content">
                <a href="{{ URL::previous() }}" class="bg-white btn btn-outline-light d-none d-sm-inline-flex"><em
                        class="icon ni ni-arrow-left"></em><span>Back</span></a>
                <a href="{{ URL::previous() }}"
                    class="bg-white btn btn-icon btn-outline-light d-inline-flex d-sm-none"><em
                        class="icon ni ni-arrow-left"></em></a>
                {{-- <a href="javascript:void(0)" wire:click.prevent='btnwa' class="btn btn-danger">WA</a> --}}
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row gy-5">
            <div class="col-lg-5">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h5 class="nk-block-title title">Informasi Data Pengajuan Pemohon</h5>
                        <p>Data Pemohon, data Tentang Bangunan, stasus pengajuan , etc.</p>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="card card-bordered">
                    <ul class="data-list is-compact">
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Nama Pemilik</div>
                                <div class="data-value">{{ $dp->nama }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Email</div>
                                <div class="data-value text-info">
                                    {{ $dp->user->email }}
                                </div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Nomor Whatsapp</div>
                                <div class="data-value text-primary">
                                    {{ convertPhoneNumber($dp->no_wa) }}
                                </div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Status Dokumen & Jenis Pengajuan</div>
                                <div class="data-value"><span
                                        class="badge badge-dim badge-sm {{ config('styles.status_upload.' . $data->status . '.class') }}">
                                        {{ config('styles.status_upload.' . $data->status . '.text') }}
                                    </span>
                                    <span class="badge bg-outline-danger">{{ $dp->jenis_pengajuan }}</span>
                                    <span class="badge bg-outline-info">{{ $data->type_dokumen->nama_dokumen }}</span>
                                </div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Last Updated</div>
                                <div class="data-value badge badge-dim bg-outline-primary">
                                    <small>
                                        {{ $data->verified_by ? Carbon::parse($data->updated_at)->isoFormat('dddd | D MMMM Y, h:mm a') : '-' }}
                                    </small>
                                </div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Jenis Konsultasi</div>
                                <div class="data-value text-info">
                                    {{ $dp->jenis_konsultasi_bangunan }}
                                </div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Lokasi Bangunan</div>
                                <div class="data-value text-info">
                                    {{ $dp->lokasi_bangunan_jalan . ', ' . $dp->lokasi_bangunan_kelurahan . ', ' . $dp->lokasi_bangunan_Kecamatan }}
                                </div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Fungsi Bangunan</div>
                                <div class="data-value text-info">
                                    {{ $dp->fungsi_bangunan }}
                                </div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Luas,Tinggi & Jumlah Lantai</div>
                                <div class="data-value text-info">
                                    {{ ($dp->luas_lahan ?? '1') . ' m2' . ' dan berjumlah ' . ($dp->jumlah_lantai ?? '1') . ' lantai' }}
                                </div>
                            </div>
                        </li>

                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Permanensi Bangunan</div>
                                <div class="data-value text-info">
                                    {{ $dp->permanensi_bangunan }}
                                </div>
                            </div>
                        </li>

                    </ul>
                </div><!-- .card -->
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h5 class="nk-block-title title">Uploaded Documents</h5>
                        <p>Data Dokumen Yang sudah Di-upload</p>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="card card-bordered">
                    <ul class="data-list is-compact">
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Document Type</div>
                                <div class="data-value">{{ $data->type_dokumen->nama_dokumen }}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">File Permohonan KRK Pemohon</div>
                                <div class="data-value">
                                    @if ($dp->hasMedia('upload_syarat_krk'))
                                        @php
                                            $media = $dp->getFirstMedia('upload_syarat_krk');
                                        @endphp
                                        <a href="{{ $media->getFullUrl() }}" target="_blank" class="title">
                                            Lihat File
                                        </a>
                                    @else
                                        File Permohonan KRK Tidak Ditemukan
                                    @endif

                                </div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">File KRK Yang Diterbitkan</div>
                                <div class="data-value">
                                    @if ($dp->hasMedia('krk'))
                                        @php
                                            $media = $dp->getFirstMedia('krk');
                                        @endphp
                                        <a href="{{ $media->getFullUrl() }}" target="_blank" class="title">
                                            Lihat File
                                        </a>
                                    @else
                                        KRK Belum Diterbitkan
                                    @endif

                                </div>
                            </div>
                        </li>
                        @foreach ($this->loadDokumen() as $b)
                            @php
                                $history = $dp->LatestDokumenUser($b->id);
                                $media = $history->getMedia($b->nama_file)->first();
                            @endphp
                            @if ($media)
                                <li class="data-item" wire:key='{{ $b->id }}'>
                                    <div class="data-col">
                                        <div class="data-label">File {{ $b->nama_dokumen }}
                                            @if ($media)
                                                <br>
                                                <small>
                                                    📄 {{ $media?->mime_type }} | 🗂
                                                    {{ number_format($media?->size / 1024, 2) }} KB
                                                </small>
                                            @endif
                                        </div>
                                        <div class="data-value">
                                            @if ($media)
                                                <div
                                                    style="padding-left:30px;padding-top:10px; display: flex; flex-wrap: nowrap; align-items: center;margin-left:40%;">
                                                    <div style="display: flex; flex-wrap: nowrap;">
                                                        <a href="#"
                                                            target="_blank" class="btn btn-outline-primary"
                                                            style="flex-shrink: 0; white-space: nowrap; min-width: auto; padding: 0px 25px; font-size: 12px;">
                                                            <em class="icon ni ni-eye text-info"></em>
                                                        </a>

                                                        <a href="#"
                                                            class="btn btn-primary"
                                                            style="flex-shrink: 0; white-space: nowrap; min-width: auto; padding: 0px 25px; font-size: 12px;">
                                                            <em class="text-white icon ni ni-download"></em>
                                                        </a>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-danger">File tidak ditemukan</span>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                        @if ($this->isAllowedReUploadDokumen() && $user->role == 'PEMOHON')
                            <li class="data-item">
                                <center> Re - Upload Dokumen For Correction</center>
                            </li>
                            <x-filepond::upload wire:model="reuploadfile" />
                            @error('reuploadfile')
                                <span class="text-danger error center">{{ $message }}</span>
                            @enderror
                            @if ($reuploadfile)
                                <br>
                                <button class="btn btn-block btn-primary" wire:click.prevent='submit_reupload'>Kirim
                                    Berkas</button>
                            @endif
                        @endif
                    </ul>
                    {{-- <div id="faqs" class="accordion">
                        <div class="accordion-item">
                            <a href="javascript:void(0)" class="accordion-head" data-bs-toggle="collapse"
                                data-bs-target="#notes_before">
                                <div class="data-col">
                                    <div class="data-label">Informasi Upload</div>
                                    <div class="data-value">Upload Yang Ke - <span
                                            class="badge bg-danger">{{ $this->jumlahUploadDokumenUser($dp->user_id) }}</span>
                                    </div>
                                    <span class="accordion-icon"></span>
                                </div>
                            </a>
                            <div class="accordion-body collapse" id="notes_before" data-bs-parent="#notes_before">
                                <div class="accordion-inner">
                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h5 class="nk-block-title title">Catatan Kesalahan Sebelumnya</h5>
                                            <p>Spesifikasi Teknis, Gambar, etc.</p>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <div class="card card-bordered">
                                        <ul class="data-list is-compact">
                                            @foreach ($this->JenisKeteranganDokumen() as $i)
                                                @php
                                                    $ket_doc = $this->GetDetailKeteranganDokumenSebelumnya($i->id);
                                                @endphp
                                                <li class="data-item">
                                                    <div class="data-col">
                                                        <div class="data-label">{{ $i->persyaratan }}</div>
                                                        <div class="data-value">
                                                            <ul class="list-status">
                                                                <li>
                                                                    @if (isset($ket_doc))
                                                                        <em
                                                                            class="icon {{ $ket_doc?->kesesuaian ? 'text-success ni ni-check-circle-fill' : 'text-danger ni ni-cross-circle-fill' }}"></em>
                                                                        <small
                                                                            class="badge badge-dim {{ $ket_doc?->kesesuaian ? 'bg-outline-success' : 'bg-outline-danger' }}">{{ $ket_doc?->kesesuaian ? 'Sudah' : 'Belum' }}</small>
                                                                    @else
                                                                        <em
                                                                            class="icon text-warning ni ni-loader"></em>

                                                                        <small
                                                                            class="badge badge-dim bg-outline-warning">Checking</small>
                                                                    @endif
                                                                </li>
                                                                <li><em
                                                                        class="icon ni ni-alert-circle text-wrap  {{ $ket_doc?->catatan ? 'text-danger' : 'text-info' }}"></em>
                                                                    <small>
                                                                        <span
                                                                            class="text-wrap {{ $ket_doc?->catatan ? 'text-danger' : 'text-info' }}">{{ $ket_doc->catatan ?? '-' }}</span>
                                                                    </small>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div><!-- .card -->
                                    <hr>
                                    <div class="card card-bordered">
                                        <div class="card-header text-info">
                                            Catatan / Keterangan Teknis Tim Ahli Sebelumnya
                                        </div>
                                        <div class="bq-note-text">
                                            <div class="form-group">
                                                <span class="text-danger text-capitalize fst-italic font-monospace">
                                                    {{ $this->GetKeteranganDokumenSebelumnya()?->keterangan }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .accordion-item -->
                    </div><!-- .accordion --> --}}
                </div><!-- .card -->
            </div><!-- .col -->
            @role(['PEMOHON'])
                <div class="col-lg-7">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title title">Informasi Upload {{ $data->type_dokumen->nama_dokumen }}
                            </h5>
                            <p>Catatan Tim Ahli untuk di koreksi
                                <span class="badge bg-primary badge-dim">Klik Focus &nbsp;<em
                                        class="card-hint icon ni ni-focus text-danger"></em>&nbsp;
                                    Untuk Melihat Lebih Detail</span>
                            </p>
                        </div>
                    </div>
                    <div class="card card-bordered">
                        <ul class="data-list is-compact">
                            @foreach ($this->JenisKeteranganDokumen() as $i)
                                @php
                                    $ket_doc = $this->GetKeteranganDokumen($i->id);
                                @endphp
                                <li class="data-item">
                                    <div class="data-col">
                                        <div class="data-label">{{ $i->persyaratan }}</div>
                                        <div class="data-value">
                                            <ul class="list-status">
                                                <li>
                                                    @if (isset($ket_doc))
                                                        <em
                                                            class="icon {{ $ket_doc?->kesesuaian ? 'text-success ni ni-check-circle-fill' : 'text-danger ni ni-cross-circle-fill' }}"></em>
                                                        <small
                                                            class="badge badge-dim {{ $ket_doc?->kesesuaian ? 'bg-outline-success' : 'bg-outline-danger' }}">{{ $ket_doc?->kesesuaian ? 'Sudah' : 'Belum' }}</small>
                                                    @else
                                                        <em class="icon text-warning ni ni-loader"></em>

                                                        <small class="badge badge-dim bg-outline-warning">Checking</small>
                                                    @endif
                                                </li>
                                                <li><em
                                                        class="icon ni ni-alert-circle text-wrap  {{ $ket_doc?->catatan ? 'text-danger' : 'text-info' }}"></em>
                                                    <small>
                                                        <span
                                                            class="text-wrap {{ $ket_doc?->catatan ? 'text-danger' : 'text-info' }}">{{ $ket_doc->catatan ?? '-' }}</span>
                                                    </small>
                                                </li>
                                                {{-- <li><a href="#modalDetailCatatanDokumenPemohon" data-bs-toggle="modal"><em
                                                            class="card-hint icon ni ni-focus link-on-primary text-danger"
                                                            data-bs-toggle="tooltip" data-bs-placement="left"
                                                            aria-label="Lihat Lebih Detail"
                                                            data-bs-original-title="Lihat Lebih Detail"></em></a>
                                                </li> --}}
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card card-bordered">
                        <div class="card-header text-info">
                            Catatan / Keterangan Teknis Tim Ahli
                        </div>
                        <div class="bq-note-text">
                            <p class="text-danger">{{ $data->keterangan ?? ' - ' }}</p>
                        </div>
                    </div>
                </div><!-- .col -->
            @endrole

            @role(['VERIFIKATOR'])
                <div class="col-lg-7">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title title">Informasi Keterangan {{ $data->type_dokumen->nama_dokumen }}
                            </h5>
                            <p>Catatan Tim Ahli untuk di koreksi</p>
                        </div>
                    </div>
                    <div class="card card-bordered">
                        <ul class="data-list is-compact">
                            @foreach ($this->JenisKeteranganDokumen() as $i)
                                <li class="data-item" wire:key='persyaratan-{{ $i->id }}'>
                                    <div class="data-col">
                                        <div class="text-black data-label">
                                            {{ $i->persyaratan }}
                                            <br>
                                            <small>
                                                <small>
                                                    Checked By :
                                                    <small class="badge bg-outline-info">
                                                        {{ $this->GetKeteranganDokumen($i->id)?->checked_by->name }}
                                                    </small>
                                                </small>
                                            </small>
                                            <br>

                                            @error('input_keterangan_sesuai.' . $i->kode)
                                                <small><small><small><span
                                                                class="text-danger fst-italic">{{ $message }}</span></small></small></small>
                                            @enderror
                                        </div>
                                        <div class="data-value">
                                            <ul class="list-status">
                                                <li>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customSwitch{{ $i->id }}"
                                                            wire:model.live='input_keterangan_sesuai.{{ $i->kode }}'
                                                            {{ $input_keterangan_sesuai[$i->kode] ? 'Checked' : '' }}
                                                            {{ $this->data->status != '0' ? 'disabled' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="customSwitch{{ $i->id }}">{{ $input_keterangan_sesuai[$i->kode] ? 'Sudah' : 'Belum' }}</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <textarea type="text" class="form-control" id="details_keterangan"
                                                        placeholder="Catatan Kesalahan Tentang {{ $i->persyaratan }}"
                                                        wire:model.live='input_catatan_gambar.{{ $i->kode }}' style="min-height: 0%" {{-- {{ $input_keterangan_sesuai[$i->kode] ? 'disabled' : '' }} --}}
                                                        {{ $this->data->status != '0' ? 'disabled' : '' }}></textarea>
                                                </li>
                                                @error('input_catatan_gambar.' . $i->kode)
                                                    <small><small><small><span
                                                                    class="text-danger fst-italic">{{ $message }}</span></small></small></small>
                                                @enderror
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card card-bordered">
                        <div class="card-header text-info">
                            Catatan / Keterangan Teknis Tim Ahli
                        </div>
                        <div class="bq-note-text">
                            <div class="form-group">
                                <textarea type="text" class="form-control" id="details_keterangan"
                                    placeholder="Catatan Teknis / Keterangan Lebih Lanjut Tim Ahli" wire:model.live='details_keterangan'
                                    {{ $this->data->status != '0' ? 'disabled' : '' }}></textarea>
                                @error('details_keterangan')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>

                    @if ($data->status == '0')
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <label class="form-label" for="s_veriif" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Pilih Status Dokumen">
                                    Verifikator Action
                                    <span class="text-danger"><em class="icon ni ni-info-i"></em></span>
                                </label>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-group" wire:ignore>
                                            <select class="form-select js-select2"
                                                data-placeholder="Select Status Dokumen Pemohon" data-search="on"
                                                id="s_veriif_sb_{{ $this->uniqueId }}" wire:model.live="status_dokumen"
                                                onchange="return setSelectBox('s_veriif_sb_{{ $this->uniqueId }}','status_dokumen');">
                                                <option value="">Select Status Dokumen</option>
                                                <option value="1">On-Checking</option>
                                                <option value="2">Need-Correction</option>
                                                <option value="3">Complete</option>
                                            </select>
                                        </div>
                                        @error($status_dokumen)
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6">
                                        <button class="btn btn-block btn-danger" wire:click="saveCatatanDokumen"
                                            wire:loading.attr="disabled" type="button">

                                            {{-- Saat tidak loading --}}
                                            <span wire:loading.remove wire:target="saveCatatanDokumen">
                                                Submit Action & Catatan
                                            </span>

                                            {{-- Saat loading --}}
                                            <span wire:loading wire:target="saveCatatanDokumen">
                                                <i class="fa fa-spinner fa-spin"></i> Sedang diproses...
                                            </span>
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div><!-- .col -->
            @endrole
        </div><!-- .row -->
        <hr>
        @if ($data->status == '1' && $user->role == 'PEMOHON')
            <div class="alert alert-pro alert-danger alert-dismissible">
                <div class="alert-text">
                    <h6>Information~</h6>
                    <p>Dokumen Anda <span class="badge bg-warning">Sedang Diperiksa</span> Oleh tim terkait, Mohon
                        Ditunggu. Apabila Sudah Selesai atau memerlukan Koreksi, System akan secara automatis
                        mengirimkan Notifikasi melalui <span class="badge bg-danger">WhatsApp</span> anda. Terimakasih
                        Telah Menunggu~</p>
                </div>
                <button class="close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        <hr>
        <div class="card-bordered">
            <div id="faqs" class="accordion">
                <div class="accordion-item">
                    <a href="javascript:void(0)" class="accordion-head" data-bs-toggle="collapse"
                        data-bs-target="#faq-q1">
                        <h6 class="title">File Upload</h6>
                        <span class="accordion-icon"></span>
                    </a>
                    <div class="accordion-body collapse show" id="faq-q1" data-bs-parent="#faqs">
                        <div class="accordion-inner">
                            <embed
                                src="#"
                                type="application/pdf" width="100%" height="1000">
                        </div>
                    </div>
                </div><!-- .accordion-item -->
            </div><!-- .accordion -->

        </div>
    </div><!-- .nk-block -->

    @livewire('modals.modal-detail-keterangan-catatan-dokumen')
</div>
