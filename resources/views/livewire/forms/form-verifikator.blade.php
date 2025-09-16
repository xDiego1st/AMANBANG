<div class="card card-inner card-bordered">
    <embed src="{{ $ldok->getFirstMediaUrl($this->GetCollectionName()) }}" style="min-height: 40rem" type="application/pdf">
    <hr>
    <div class="nk-block-head">
        <div class="justify-between nk-block-head-content d-flex align-items-center">
            <h5 class="mb-0 nk-block-title title">
                Informasi Keterangan {{ $ldok->type_dokumen->nama_dokumen }}
                <span
                    class="badge badge-dim {{ config('styles.status_upload.' . $ldok->status . '.class') }}">{{ config('styles.status_upload.' . $ldok->status . '.text') }}</span>
            </h5>
            @if ($ldok->status == '0' || $ldok->status == '1')
                <button type="button" class="btn btn-sm btn-primary d-inline-flex align-items-center"
                    wire:click="checkAll" wire:loading.attr="disabled" wire:target="checkAll">
                    {{-- Icon normal --}}
                    <em class="icon ni ni-check-circle me-1" wire:loading.remove wire:target="checkAll"></em>
                    {{-- Spinner saat loading --}}
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true" wire:loading
                        wire:target="checkAll"></span>

                    <span wire:loading.remove wire:target="checkAll">Check All</span>
                    <span wire:loading wire:target="checkAll">Memproses...</span>
                </button>
            @endif
        </div>

        <p class="mt-1 mb-0">Catatan Tim Ahli untuk di koreksi</p>
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
                                    Diperiksa Oleh :
                                    <small class="badge bg-outline-info">
                                        {{ $this->GetKeteranganDokumen($i->id)?->checked_by->name }}
                                    </small>
                                </small>
                                <br>
                                <small>
                                    <span class="badge badge-dim bg-primary">Pada :
                                        {{ convert_date2($this->GetKeteranganDokumen($i->id)?->updated_at) }}</span>
                                </small>
                            </small>
                            <br>

                            @error('input_keterangan_sesuai.' . $i->kode)
                                <small><small><small><span
                                                class="text-danger fst-italic">{{ $message }}</span></small></small></small>
                            @enderror
                        </div>
                        <div class="pt-2 data-value">
                            <ul class="list-status gy-2">
                                <li>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input"
                                            id="customSwitch{{ $i->id }}"
                                            wire:model.live='input_keterangan_sesuai.{{ $i->kode }}'
                                            {{ $input_keterangan_sesuai[$i->kode] ? 'Checked' : '' }}
                                            {{ $ldok->status != '0' ? 'disabled' : '' }}>
                                        <label class="custom-control-label"
                                            for="customSwitch{{ $i->id }}">{{ $input_keterangan_sesuai[$i->kode] ? 'Sudah' : 'Belum' }}</label>
                                    </div>
                                </li>
                                <li>
                                    <textarea type="text" class="form-control" id="details_keterangan"
                                        placeholder="Catatan Kesalahan Tentang {{ $i->persyaratan }}"
                                        wire:model.live='input_catatan_gambar.{{ $i->kode }}' style="min-height: 0%" {{-- {{ $input_keterangan_sesuai[$i->kode] ? 'disabled' : '' }} --}}
                                        {{ $ldok->status != '0' || $input_keterangan_sesuai[$i->kode] ? 'disabled' : '' }}></textarea>
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
    <div class="card card-bordered" >
        <div class="card-header text-info">
            Catatan / Keterangan Teknis Tim Ahli
        </div>
        <div class="bq-note-text">
            <div class="form-group">
                <textarea type="text" class="form-control" id="details_keterangan"
                    placeholder="Catatan Teknis / Keterangan Lebih Lanjut Tim Ahli" wire:model.live='details_keterangan'
                    {{ $this->ldok->status != '0' ? 'disabled' : '' }}></textarea>
                @error('details_keterangan')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <hr>

    @if ($ldok->status == '0')
        <div class="form-group">
            <div class="form-control-wrap">
                <label class="form-label" for="s_veriif" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Pilih Status Dokumen">
                    Verifikator Action
                    <span class="text-danger"><em class="icon ni ni-info-i"></em></span>
                </label>
                <div class="row">
                    @if ($status_dokumen == '2')
                        <div class="col-lg-12">
                            <span class="badge badge-md bg-danger text-wrap btn-block">Silahkan
                                Upload Dokumen Catatan Koreksi Kepada Pemohon dibawah ini :</span>
                            <hr>
                            <x-filepond::upload wire:model="file_koreksi" required />
                            @error('file_koreksi')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                    <div class="col-lg-6">
                        <div class="input-group" wire:ignore>
                            <select class="form-select js-select2" data-placeholder="Select Status Dokumen Pemohon"
                                data-search="on" id="s_veriif_sb_{{ $this->uniqueId }}"
                                onchange="return setSelectBox('s_veriif_sb_{{ $this->uniqueId }}','status_dokumen',true);">
                                <option value="">Select Status Dokumen</option>
                                {{-- <option value="1">On-Checking</option> --}}
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

</div>
