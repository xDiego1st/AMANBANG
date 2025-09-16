<div class="row g-gs">
    <div class="col-lg-12">
        <div class="card card-bordered">
            <div class="card-inner">
                <span class="preview-title-lg overline-title">Pendataan Informasi Pemohon #
                    {{ $ids ?? '-' }} SIMBG</span>
                <div class="row g-gs">
                    @php $d = $this->data; @endphp
                    {{-- Ringkasan Cepat --}}
                    <div class="col-12">
                        <div class="border-0 shadow-sm card">
                            <div class="flex-wrap gap-2 card-body d-flex align-items-center">
                                <span class="badge rounded-pill bg-dark">ID #{{ $d?->id ?? '-' }}</span>

                                {{-- Jenis Pengajuan --}}
                                <span
                                    class="badge rounded-pill {{ $d?->jenis_pengajuan === 'PBG' ? 'bg-primary' : 'bg-warning text-dark' }}">
                                    {{ $d?->jenis_pengajuan ?? '-' }}
                                </span>

                                {{-- Tim Penilai BA --}}
                                <span class="badge rounded-pill bg-info text-dark">
                                    Tim: {{ $d?->team_penilai_ba ?? '-' }}
                                </span>

                                {{-- Status --}}
                                @php [$stLabel,$stClass] = $this->statusBadge($d?->status); @endphp
                                <span class="badge rounded-pill {{ $stClass }}">{{ $stLabel }}</span>

                                {{-- Nomor Registrasi (copyable) --}}
                                <div class="gap-2 pt-4 ms-auto d-flex align-items-center">
                                    <span class="text-muted">No. Reg SIMBG:</span>
                                    <code id="regSimbgText" class="px-2 py-1 rounded bg-light">
                                        {{ $d?->nomor_registrasi_simbg ?? '-' }}
                                    </code>
                                    <button class="btn btn-sm btn-outline-secondary" x-data
                                        x-on:click="navigator.clipboard.writeText(document.getElementById('regSimbgText').innerText)">
                                        Copy
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    {{-- Identitas Pemohon --}}
                    <div class="col-lg-6">
                        <div class="border-0 shadow-sm card h-100">
                            <div class="card-header bg-light">
                                <div class="gap-2 d-flex align-items-center">
                                    <em class="icon ni ni-user"></em>
                                    <strong>Identitas Pemohon</strong>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row gy-3">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted">Nama</span>
                                            <span class="fw-semibold">{{ $this->disp($d?->nama) }}</span>
                                        </div>
                                        <hr class="my-2">
                                    </div>

                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-muted">No. WhatsApp</span>
                                            <span class="fw-semibold">
                                                {{ $this->disp($d?->no_wa) }}
                                                @if ($d?->no_wa)
                                                    <a class="btn btn-xs btn-outline-success ms-2" target="_blank"
                                                        href="https://wa.me/{{ preg_replace('/\D/', '', $d->no_wa) }}">
                                                        Chat
                                                    </a>
                                                @endif
                                            </span>
                                        </div>
                                        <hr class="my-2">
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-muted">Email</span>
                                            <span class="fw-semibold">
                                                {{ $this->disp($d?->user->email) }}
                                            </span>
                                        </div>
                                        <hr class="my-2">
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted">Alamat</span>
                                            <span class="fw-semibold text-end">{{ $this->disp($d?->alamat) }}</span>
                                        </div>
                                        <hr class="my-2">
                                    </div>

                                    <div class="col-12">
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted">Pekerjaan</span>
                                            <span class="fw-semibold">{{ $this->disp($d?->pekerjaan) }}</span>
                                        </div>
                                        <hr class="my-2">
                                    </div>

                                    <div class="col-12">
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted">Bertindak Atas Nama</span>
                                            <span
                                                class="fw-semibold">{{ $this->disp($d?->bertindak_atas_nama) }}</span>
                                        </div>
                                        <hr class="my-2">
                                    </div>

                                    <div class="col-12">
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted">Jabatan</span>
                                            <span class="fw-semibold">{{ $this->disp($d?->jabatan) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Lokasi Bangunan --}}
                    <div class="col-lg-6">
                        <div class="border-0 shadow-sm card h-100">
                            <div class="card-header bg-light">
                                <div class="gap-2 d-flex align-items-center">
                                    <em class="icon ni ni-map-pin"></em>
                                    <strong>Lokasi Bangunan</strong>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row gy-3">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted">Jalan</span>
                                            <span
                                                class="fw-semibold">{{ $this->disp($d?->lokasi_bangunan_jalan) }}</span>
                                        </div>
                                        <hr class="my-2">
                                    </div>

                                    <div class="col-12">
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted">Kelurahan</span>
                                            <span
                                                class="fw-semibold">{{ $this->disp($d?->lokasi_bangunan_kelurahan) }}</span>
                                        </div>
                                        <hr class="my-2">
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted">Kecamatan</span>
                                            <span
                                                class="fw-semibold">{{ $this->disp($d?->lokasi_bangunan_Kecamatan) }}</span>
                                        </div>
                                        <hr class="my-2">
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted">Koordinat</span>
                                            <span class="fw-semibold">
                                                {{ $this->disp($d?->koordinat_lokasi) }}</span>
                                        </div>
                                        <hr class="my-2">
                                    </div>
                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Petunjuk Arah</span>
                                        <span class="fw-semibold">
                                            @if ($link = $this->mapsLink($d?->koordinat_lokasi))
                                                <a class="btn btn-xs btn-outline-primary ms-2" target="_blank"
                                                    href="{{ $link }}">Lihat Peta</a>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Data Bangunan --}}
                    <div class="col-12">
                        <div class="border-0 shadow-sm card">
                            <div class="card-header bg-light">
                                <div class="gap-2 d-flex align-items-center">
                                    <em class="icon ni ni-home"></em>
                                    <strong>Data Bangunan</strong>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row gy-3">
                                    <div class="col-md-4">
                                        <div class="text-muted">Nama Bangunan</div>
                                        <div class="fw-semibold">{{ $this->disp($d?->nama_bangunan) }}</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-muted">Fungsi Bangunan</div>
                                        <div class="fw-semibold">{{ $this->disp($d?->fungsi_bangunan) }}</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-muted">Jenis Konsultasi</div>
                                        <div class="fw-semibold">{{ $this->disp($d?->jenis_konsultasi_bangunan) }}
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="text-muted">Jumlah Unit/Kavling</div>
                                        <div class="fw-semibold">{{ $this->disp($d?->jumlah_unit_kavling) }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-muted">Jumlah Lantai</div>
                                        <div class="fw-semibold">{{ $this->disp($d?->jumlah_lantai) }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-muted">Luas Lahan (m²)</div>
                                        <div class="fw-semibold">{{ $this->formatLuas($d?->luas_lahan) }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-muted">Permanensi</div>
                                        <div class="fw-semibold">{{ $this->disp($d?->permanensi_bangunan) }}</div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="text-muted">Rencana Jenis Kegiatan</div>
                                        <div class="fw-semibold">{{ $this->disp($d?->rencana_jenis_kegiatan) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Status & Timeline --}}
                    <div class="col-12">
                        <div class="border-0 shadow-sm card">
                            <div class="card-header bg-light">
                                <div class="gap-2 d-flex align-items-center">
                                    <em class="icon ni ni-clock"></em>
                                    <strong>Status & Timeline</strong>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row gy-3">
                                    <div class="col-md-4">
                                        <div class="text-muted">Verified Operator At</div>
                                        <div class="fw-semibold">{{ $this->fmtDate($d?->verified_operator_at) }}</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-muted">Finish At</div>
                                        <div class="fw-semibold">{{ $this->fmtDate($d?->finish_at) }}</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-muted">Created / Updated</div>
                                        <div class="fw-semibold">
                                            {{ $this->fmtDate($d?->created_at) }} &middot;
                                            {{ $this->fmtDate($d?->updated_at) }}
                                        </div>
                                    </div>
                                </div>

                                {{-- Progress bar ringan sesuai status --}}
                                <div class="mt-3">
                                    @php $progress = $this->statusProgress($d?->status); @endphp
                                    <div class="progress" style="height:10px;">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small class="text-muted">Progress: {{ $progress }}%</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> {{-- /.row --}}
                <hr>
                <div class="row g-gs">
                    @if ($this->data?->status == 1)
                        {{-- jika KRK Telah Diterbitkan --}}
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="nomor_registrasi_simbg">Nomor Registrasi
                                    SIMBG</label>
                                <input type="text" class="form-control" id="nomor_registrasi_simbg"
                                    placeholder="Ex : - " wire:model.live='nomor_registrasi_simbg'>
                                @error('nomor_registrasi_simbg')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label class="form-label" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Pilih Tim Ahli Yang Ditunjuk">
                                    Pilih Tim Ahli
                                    <span class="text-danger"><em class="icon ni ni-info-i"></em></span>
                                </label>
                                <div class="input-group" wire:ignore>
                                    <select id="fb_sb_{{ $this->uniqueId }}" class="form-select js-select2"
                                        multiple="multiple" data-placeholder="Pilih Tim Ahli Yang Ditunjuk"
                                        onchange="return setSelectBox('fb_sb_{{ $this->uniqueId }}','selected_tim_ahli');">
                                        @foreach ($this->getListUserByRole('VERIFIKATOR') as $i)
                                            <option value="{{ $i->id }}">
                                                {{ $i->name }} |
                                                {{ config('styles.type_validator.' . $i->type_validator . '.text') }}
                                                | {{ $i->jenis_user }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('selected_tim_ahli')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-12 col-md-12">
                            <div class="form-group">
                                <label class="form-label" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Pilih Pengawas Yang Ditunjuk">
                                    Pilih Pengawas
                                    <span class="text-danger"><em class="icon ni ni-info-i"></em></span>
                                </label>
                                <div class="input-group" wire:ignore>
                                    <select id="tp_sb_{{ $this->uniqueId }}" class="form-select js-select2"
                                        multiple="multiple" data-placeholder="Pilih Pengawas Yang Ditunjuk"
                                        onchange="return setSelectBox('tp_sb_{{ $this->uniqueId }}','selected_pengawas');">
                                        @foreach ($this->getListUserByRole('PENGAWAS') as $i)
                                            <option value="{{ $i->id }}">
                                                {{ $i->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('selected_pengawas')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif

                    @if ($data?->jenis_pengajuan == 'PBG' && $data?->status == '0')
                        <div class="col-lg-12">
                            <span class="badge badge-md bg-danger text-wrap btn-block">Silahkan
                                Upload KRK Pemohon Yang Telah ditandatangi dibawah ini</span>
                            <hr>
                            <x-filepond::upload wire:model="files_upload_krk" required />
                            @error('files_upload_krk')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                    @if (!$data?->nomor_registrasi_simbg && $data?->status == '1')
                        @foreach ($this->loadDokumen() as $dok)
                            <div class="col-lg-12">
                                <span
                                    class="badge badge-md {{ config('styles.dokumen.' . $dok->id . '.class') }} text-wrap btn-block">Silahkan
                                    Upload {{ $dok->nama_dokumen }} Pemohon Yang Terupload Di SIMBG</span>
                                <hr>
                                <x-filepond::upload wire:model="{{ $dok->nama_file }}" required />
                                @error('{{ $dok->nama_file }}')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div><!-- .card -->
    </div><!-- .col -->
    <div class="col-12">
        <div class="form-group">
            <button wire:click.prevent="submit" wire:loading.attr="disabled" type="button"
                class="btn btn-primary btn-lg btn-block">

                <span wire:loading.remove wire:target="submit">
                    Submit Data
                </span>
                <span wire:loading wire:target="submit">
                    <i class="fa fa-spinner fa-spin"></i> Proses...
                </span>
            </button>

        </div>
    </div>
</div><!-- .row -->
