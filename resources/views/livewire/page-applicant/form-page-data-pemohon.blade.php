<div class="row g-gs">
    <div class="col-lg-8">
        <div class="card card-bordered">
            <div class="card-inner">
                <span class="preview-title-lg overline-title">Pendataan Informasi Bangunan Pemohon</span>
                <img src="{{ asset('images/proses-amanbang.webp') }}" alt="banner1">
                <hr>
                <div class="row g-gs">
                    <div class="col-sm-12 col-lg-6 col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="nama_bangunan">Nama Bangunan</label>
                            <input type="text" class="form-control" id="nama_bangunan"
                                placeholder="Ex : Perumahan Citraland Kav.05/21" wire:model.live='nama_bangunan'>
                            @error('nama_bangunan')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6 col-md-6">
                        <div class="form-group">
                            <label class="form-label" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Pilih Fungsi Bangunan">
                                Fungsi Bangunan
                                <span class="text-danger"><em class="icon ni ni-info-i"></em></span>
                            </label>
                            <div class="input-group" wire:ignore>
                                <select id="fb_sb_{{ $this->uniqueId }}" class="form-select js-select2" data-search="on"
                                    data-placeholder="Pilih Fungsi Bangunan"
                                    onchange="return setSelectBox('fb_sb_{{ $this->uniqueId }}','fungsi_bangunan');">
                                    <option value="">Select Option</option>
                                    @foreach ($fungsi_bangunan_list as $i)
                                        <option value="{{ $i }}"
                                            {{ $fungsi_bangunan == $i ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('fungsi_bangunan')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6 col-md-6">
                        <div class="form-group">
                            <label class="form-label" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Pilih Jenis Konsultasi Bangunan">
                                Jenis Konsultasi Bangunan
                                <span class="text-danger"><em class="icon ni ni-info-i"></em></span>
                            </label>
                            <div class="input-group" wire:ignore>
                                <select id="jr_sb_{{ $this->uniqueId }}" class="form-select js-select2" data-search="on"
                                    data-placeholder="Pilih Jenis Konsultasi Bangunan"
                                    onchange="return setSelectBox('jr_sb_{{ $this->uniqueId }}','jenis_konsultasi_bangunan');">
                                    <option value="">Select Option</option>
                                    @foreach ($jenis_rumah_list as $i)
                                        <option value="{{ $i }}"
                                            {{ $jenis_konsultasi_bangunan == $i ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('jenis_konsultasi_bangunan')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 col-md-3">
                        <div class="form-group">
                            <label class="form-label" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Pilih Permanensi Bangunan">
                                Permanensi Bangunan
                                <span class="text-danger"><em class="icon ni ni-info-i"></em></span>
                            </label>
                            <div class="input-group" wire:ignore>
                                <select id="pb_sb_{{ $this->uniqueId }}" class="form-select js-select2"
                                    data-search="on" data-placeholder="Pilih Permanensi Bangunan"
                                    onchange="return setSelectBox('pb_sb_{{ $this->uniqueId }}','permanensi');">
                                    <option value="">Select Option</option>
                                    @foreach ($permanensi_list as $i)
                                        <option value="{{ $i }}" {{ $permanensi == $i ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('permanensi')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 col-md-3">
                        <div class="form-group">
                            <label class="form-label" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Pilih Jenis Pengajuan">
                                Jenis Pengajuan
                                <span class="text-danger"><em class="icon ni ni-info-i"></em></span>
                            </label>
                            <div class="input-group" wire:ignore>
                                <select id="pj_sb_{{ $this->uniqueId }}" class="form-select js-select2"
                                    data-search="on" data-placeholder="Pilih Jenis Pengajuan"
                                    onchange="return setSelectBox('pj_sb_{{ $this->uniqueId }}','jenis_pengajuan');">
                                    <option value="">Select Option</option>
                                    @foreach ($pengajuan_list as $i)
                                        <option value="{{ $i }}"
                                            {{ $jenis_pengajuan == $i ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('jenis_pengajuan')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 col-md-3">
                        <div class="form-group">
                            <label class="form-label" for="jumlah_unit">Rencana Jumlah
                                Unit/Kavling</label>
                            <span class="text-danger"><em class="icon ni ni-info-i"></em></span>
                            <input type="text" class="form-control" id="jumlah_unit" placeholder="Ex : 1"
                                wire:model.live='jumlah_unit'>
                            @error('jumlah_unit')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 col-md-3">
                        <div class="form-group">
                            <label class="form-label" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Pilih Unit Bangunan">
                                Unit Bangunan
                                <span class="text-danger"><em class="icon ni ni-info-i"></em></span>
                            </label>
                            <div class="input-group" wire:ignore>
                                <select id="ub_sb_{{ $this->uniqueId }}" class="form-select js-select2"
                                    data-search="on" data-placeholder="Pilih Unit Bangunan"
                                    onchange="return setSelectBox('ub_sb_{{ $this->uniqueId }}','unit_bangunan');">
                                    <option value="">Select Option</option>
                                    @foreach ($unit_bangunan_list as $i)
                                        <option value="{{ $i }}"
                                            {{ $unit_bangunan == $i ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('unit_bangunan')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 col-md-3">
                        <div class="form-group">
                            <label class="form-label" for="jumlah_lantai">Rencana Jumlah
                                Lantai</label>
                            <span class="text-danger"><em class="icon ni ni-info-i"></em></span>
                            <div class="form-control-wrap">
                                <div class="form-text-hint">
                                    <span class="overline-title">LANTAI</span>
                                </div>
                                <input type="text" class="form-control" id="jumlah_lantai" placeholder="Ex : 2"
                                    wire:model.live='jumlah_lantai'>
                                @error('jumlah_lantai')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 col-md-3">
                        <div class="form-group">
                            <label class="form-label" for="luas_lahan">Rencana Luas Lahan</label>
                            <span class="text-danger"><em class="icon ni ni-info-i"></em></span>
                            <div class="form-control-wrap">
                                <div class="form-text-hint">
                                    <span class="overline-title">M2</span>
                                </div>
                                <input type="text" class="form-control" id="luas_lahan" placeholder="Ex : 200"
                                    wire:model.live='luas_lahan'>
                                @error('luas_lahan')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-4 col-md-6">
                        <span class="overline-title">Lokasi Bangunan</span>
                        <div class="form-group">
                            <label class="form-label" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Pilih Kelurahan Lokasi Bangunan">
                                Kelurahan
                                <span class="text-danger"><em class="icon ni ni-info-i"></em></span>
                            </label>
                            <div class="input-group" wire:ignore>
                                <select id="kelurahan_selectbox" class="form-select js-select2" data-search="on"
                                    data-placeholder="Pilih Kelurahan Peserta"
                                    onchange="return setSelectBox('kelurahan_selectbox','kelurahan');">
                                    <option value="">Select Option</option>
                                    @foreach ($list_kelurahan as $i)
                                        <option value="{{ $i->name }}"
                                            {{ $kelurahan == $i->name ? 'selected' : '' }}>
                                            {{ $i->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('kelurahan')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-4 col-md-4">
                        <span class="overline-title">Lokasi Bangunan</span>
                        <div class="form-group">
                            <label class="form-label" for="koordinat_lokasi" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Format Lokasi : Lat,Lng">Koordinat
                                Lokasi</label>
                            <span class="text-danger"><em class="icon ni ni-info-i"></em></span>
                            <input type="text" class="form-control" id="koordinat_lokasi"
                                placeholder="Ex : 0.5078182,101.4662837" wire:model.live='koordinat_lokasi'>
                            {{-- @error('koordinat_lokasi')
                                <span class="error">{{ $message }}</span>
                            @enderror --}}
                            @if ($errors->has('koordinat_lokasi'))
                                <span class="error"> {{ $errors->first('koordinat_lokasi') }}</span>
                            @endif
                            {{-- @if ($errors->has($koordinat_lokasi))
                                <span class="error">{{ $errors->first($koordinat_lokasi) }}</span>
                            @else
                                <small> <span class="text-info decoration-white">Note : Lat , Lng</span></small>
                            @endif --}}
                        </div>
                    </div>
                    <div class="col-12">
                        <span class="overline-title">Lokasi Bangunan</span>
                        <div class="form-group">
                            <label class="form-label" for="lokasi_jalan_bangunan">Jalan</label>

                            <span class="text-danger"><em class="icon ni ni-info-i"></em></span>
                            <textarea type="text" class="form-control" id="lokasi_jalan_bangunan" placeholder="Lokasi Jalan Bangunan"
                                wire:model.live='lokasi_jalan_bangunan'></textarea>
                            @error('lokasi_jalan_bangunan')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    @if ($this->jenis_pengajuan == 'PBG' && !$this->ids)
                        <div class="col-lg-12">
                            <span class="overline-title">Dokumen KRK Yang Dibubuhi Materai</span>
                            <hr>
                            <span class="m-4 badge badge-md bg-danger text-wrap">Silahkan
                                Download Formulir KRK Dibawah
                                ini,
                                Cetak dan isi secara manual & lengkapi syarat syarat yang
                                diperlukan
                                lalu upload berkas tersebut dibawah ini termasuk Formulir Surat KRK</span>
                            <button class="btn bg-outline-danger btn-block"
                                wire:click.prevent='DownloadFormulirKRK'>Download Formulir Surat
                                KRK</button>
                            <hr>
                            <x-filepond::upload wire:model="files_upload_krk" multiple max-files="5" required />
                            @error('files_upload_krk')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                </div>
            </div>
        </div><!-- .card -->
    </div><!-- .col -->
    <div class="col-lg-4">
        <div class="col-lg-12">
            <div class="card card-bordered">
                <div class="card-inner">
                    <span class="preview-title-lg overline-title">Pendataan Data Pemohon</span>
                    <div class="row g-gs">
                        <div class="col-sm-12 col-lg-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="name" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Tulis Nama Pemilik">
                                    Nama Pemohon
                                    <span class="text-danger"><em class="icon ni ni-info-i"></em></span>
                                </label>
                                <input type="text" class="form-control" id="name" placeholder="Nama Pemohon"
                                    wire:model.live='name'>
                                @error('name')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="bertindak_atas_nama">Bertindak Atas
                                    Nama</label>
                                <div class="form-control-wrap">
                                    <input type="text" wire:model.live='bertindak_atas_nama' class="form-control"
                                        id="bertindak_atas_nama" placeholder="Mengajukan Permohonan Atas Nama">
                                    @error('bertindak_atas_nama')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Pilih Pekerjaan">
                                    Pekerjaan
                                    <span class="text-danger"><em class="icon ni ni-info-i"></em></span>
                                </label>
                                <div class="input-group" wire:ignore>
                                    <select id="pp_sb_{{ $this->uniqueId }}" class="form-select js-select2"
                                        data-search="on" data-placeholder="Pilih Pekerjaan"
                                        onchange="return setSelectBox('pp_sb_{{ $this->uniqueId }}','pekerjaan');">
                                        <option value="">Select Option</option>
                                        @foreach ($pekerjaan_list as $i)
                                            <option value="{{ $i }}"
                                                {{ $pekerjaan == $i ? 'selected' : '' }}>
                                                {{ $i }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('permanensi')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="jabatan">Jabatan</label>
                                <div class="form-control-wrap">
                                    <input type="text" wire:model.live='jabatan' class="form-control"
                                        id="jabatan" placeholder="Jabatan Pemohon">
                                    @error('jabatan')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="alamat">Alamat</label>
                                <span class="text-danger"><em class="icon ni ni-info-i"></em></span>
                                <div class="form-control-wrap">
                                    <textarea type="text" wire:model.live='alamat'class="form-control" id="alamat"
                                        placeholder="Alamat Rumah Pemohon.."></textarea>
                                    @error('alamat')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .card -->
        </div>
        <hr>
        <div class="col-lg-12">
            <div class="card card-bordered">
                <div class="card-inner">
                    <div class="nk-fmg-listing nk-block-lg">
                        <div class="nk-block-head-xs">
                            <div class="nk-block-between g-2">
                                <div class="nk-block-head-content">
                                    <h6 class="nk-block-title title">Dokumen KRK</h6>
                                </div>
                                <div class="nk-block-head-content">
                                    <ul class="nk-block-tools g-3 nav" role="tablist">
                                        <li><a data-bs-toggle="tab" href="#file-list-view"
                                                class="nk-switch-icon active" aria-selected="true" role="tab"><em
                                                    class="icon ni ni-view-row-wd"></em></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- .nk-block-head -->
                        <div class="tab-content">
                            <div class="tab-pane active show" id="file-list-view" role="tabpanel">
                                <div class="nk-files nk-files-view-list">
                                    @if ($this->data && $this->data->hasMedia('upload_syarat_krk'))
                                        @php
                                            $mediaItems = $this->data->getMedia('upload_syarat_krk');
                                        @endphp

                                        @foreach ($mediaItems as $index => $media)
                                            <div class="nk-file-item nk-file">
                                                <div class="nk-file-info">
                                                    <div class="nk-file-title">
                                                        {{-- Ikon file --}}
                                                        <div class="nk-file-icon">
                                                            <span class="nk-file-icon-type">
                                                                @if (Str::startsWith($media->mime_type, 'image/'))
                                                                    <em class="icon ni ni-img"></em>
                                                                @elseif ($media->mime_type === 'application/pdf')
                                                                    <em class="icon ni ni-file-pdf"></em>
                                                                @else
                                                                    <em class="icon ni ni-file"></em>
                                                                @endif
                                                            </span>
                                                        </div>

                                                        {{-- Nama file (klik → buka modal preview) --}}
                                                        <div class="nk-file-name">
                                                            <div class="nk-file-name-text">
                                                                <a href="{{ $media->getFullurl() }}" target="_blank"
                                                                    class="title">
                                                                    {{ $media->file_name }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .nk-file -->
                                        @endforeach
                                    @else
                                        <p class="text-muted">Belum ada file yang diupload.</p>
                                    @endif
                                </div>

                            </div><!-- .tab-pane -->
                        </div><!-- .tab-content -->
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="col-lg-12">
            <span class="overline-title">Notice</span>
            <hr>
            <span class="m-4 badge badge-md badge-dim bg-outline-danger text-wrap">Dokumen Permohonan KRK Asli Wajib
                Dikirimkan ke MPP
                pada loket Pelayanan PBG Pada Jam Kerja</span>
            {{-- <span class="badage badge-dim bg-outline-info">Pada Jam Kerja</span> --}}
        </div>
    </div><!-- .col -->
    <div class="col-12">
        <div class="form-group">
            <button wire:click.prevent="submitKRK" wire:loading.attr="disabled" wire:target="submitKRK"
                type="button" class="btn btn-lg btn-block {{ $this->ids ? 'btn-danger' : 'btn-primary' }}">

                {{-- Saat loading tampil spinner --}}
                <span wire:loading wire:target="submitKRK">
                    <i class="spinner-border spinner-border-sm"></i> Memproses...
                </span>

                {{-- Saat tidak loading tampilkan teks sesuai kondisi --}}
                <span wire:loading.remove wire:target="submitKRK">
                    {{ $this->ids ? 'Save Data' : 'Submit Data' }}
                </span>
            </button>
        </div>
    </div>

</div><!-- .row -->
