<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title text-primary">Aplikasi Manajemen Bangunan Gedung -
                    <span class="font-mono text-white badge badge-md overline-title bg-warning">AMANBANG</span>
                    <span class="badge badge-md bg-outline-info badge-dim overline-title">Aplikasi Pendukung SIMBG</span>
                </h3>
                <p class="text-black"><span class="badge bg-outline-info badge-dim">Welcome {{ $user->name }}</span>
                    <span class="badge bg-outline-info badge-dim">{{ $user->detailPemohon()->jenis_pengajuan }}</span>
                    <a href="#" class="collapsed badge bg-outline-success badge-dim" data-bs-toggle="collapse"
                        data-bs-target="#faq-q1" aria-expanded="false">#{{ $this->data?->nomor_registrasi_simbg }}</a>
                <div class="nk-block-des">
                    @if ($this->data?->nomor_registrasi_simbg)
                        <p>Anda Mempunyai total {{ $this->countStatusDokumen() }} Dokumen yang harus direvisi/dilengkapi & upload</a> </p>
                    @else
                        <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#faq-q1"
                            aria-expanded="false">
                            <div class="nk-block-des text-soft">
                                <small><span class="badge bg-primary"> Klik Disini untuk Input Nomor
                                        Registrasi SIMBG</span></small> -
                                <small class="text-danger">Silahkan Download KRK Yang telah disetujui dan lakukan
                                    pengajuan pada Simbg untuk
                                    mendapatkan <span class="text-success">Nomor Registrasi SIMBG</span>.
                                    <br> Setelah melewati verifikasi, Anda Dapat Meng-Upload Dokumen Yang Terkait Disini
                                    <span class="text-success">untuk
                                        percepatan validasi</span>
                                    berkas PBG / SLF</small>
                            </div>
                        </a>
                    @endif
                </div>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="javascript:void(0)" class="btn btn-icon btn-trigger toggle-expand me-n1"
                        data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                <a href="javascript:void(0)" target="_blank" wire:click="downloadMedia('{{ encrypt($this->ids) }}', 'krk')"
                                    class="toggle btn btn-icon btn-danger btn-dim d-md-none"><em
                                        class="icon ni ni-reports"></em></a>
                                <a href="javascript:void(0)" target="_blank" wire:click="downloadMedia('{{ encrypt($this->ids) }}', 'krk')"
                                    class="toggle btn btn-danger btn-dim d-none d-md-inline-flex"><em
                                        class="icon ni ni-reports"></em><span>Download KRK</span></a>
                            </li>
                            <li class="nk-block-tools-opt">
                                <a href="javascript:void(0)" target="_blank" wire:click.prevent="downloadBA('{{ encrypt($this->ids) }}')"
                                    class="toggle btn btn-icon btn-outline-success btn-dim d-md-none"><em
                                        class="icon ni ni-reports"></em></a>
                                <a href="javascript:void(0)" target="_blank" wire:click.prevent="downloadBA('{{ encrypt($this->ids) }}')"
                                    class="toggle btn btn-outline-success btn-dim d-none d-md-inline-flex"><em
                                        class="icon ni ni-reports"></em><span>Download Berita
                                        Acara</span></a>
                            </li>
                            <li class="nk-block-tools-opt">
                                <a href="https://simbg.pu.go.id/" target="_blank"
                                    class="toggle btn btn-icon btn-primary d-md-none"><em
                                        class="icon ni ni-forward"></em></a>
                                <a href="https://simbg.pu.go.id/" target="_blank"
                                    class="toggle btn btn-primary d-none d-md-inline-flex"><em
                                        class="icon ni ni-forward"></em><span>SIMBG</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
        @if (!$this->data?->nomor_registrasi_simbg)
            <div class="accordion-item">
                <div class="accordion-body collapse" id="faq-q1" data-bs-parent="#faqs" style=""
                    wire:ignore.self>
                    <div class="accordion-inner">
                        <div class="form-group">
                            <div class="gx-3 d-flex">
                                <input type="text" class="form-control" id="nomor_registrasi_simbg"
                                    placeholder="Masukkan Nomor Registrasi SIMBG"
                                    wire:model.live='nomor_registrasi_simbg'>

                                <a href="#" class="btn btn-icon btn-primary d-md-none"
                                    wire:click.prevent='saveNomorRegistrasiSimbg'><em
                                        class="icon ni ni-save-fill"></em></a>
                                <a href="#" class="btn btn-primary d-none d-md-inline-flex"
                                    wire:click.prevent='saveNomorRegistrasiSimbg'><em
                                        class="icon ni ni-save-fill"></em><span>Save</span></a>
                                @error('nomor_registrasi_simbg')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .accordion-item -->
        @endif
    </div><!-- .nk-block-head -->
    <hr>

    <div class="nk-block {{ !$this->data?->nomor_registrasi_simbg ? 'lock-overlay' : '' }}">
        @if (!$this->data?->nomor_registrasi_simbg)
            <div class="overlay-message">
                Harap masukkan nomor registrasi terlebih dahulu.
            </div>
        @endif
        <div class="row g-gs">
            <div class="col-lg-9">
                <div class="row g-gs">
                    @foreach ($this->loadDokumen() as $i)
                        @php
                            $doktb = $this->loadStatusDokumen($i->id);
                        @endphp
                        @if (!$doktb || $doktb->status == '2')
                            <div class="col-sm-6 col-lg-4 col-xxl-4">
                                <div class="card h-100">
                                    <div class="card-inner">
                                        <div class="project">
                                            <div class="project-head">
                                                <a href="javascript:void(0)" class="project-title">
                                                    <img class="user-avatar sm" style="height: 40px;width: 40px"
                                                        src="{{ asset('images/file-default.png') }}">
                                                    <div class="project-info">
                                                        <h6 class="title">{{ $i->nama_dokumen }}</h6>
                                                        <span
                                                            class="sub-text">#{{ $this->data?->nomor_registrasi_simbg }}</span>
                                                    </div>
                                                </a>
                                                <div class="drodown">
                                                    <a href="javascript:void(0)"
                                                        class="dropdown-toggle btn btn-sm btn-icon btn-trigger mt-n1 me-n1"
                                                        data-bs-toggle="dropdown"><em
                                                            class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="javascript:void(0)"><em
                                                                        class="icon ni ni-eye"></em><span>Lihat Contoh
                                                                        Berkas / Dokumen
                                                                        Project</span></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="project-details">
                                                <x-filepond::upload wire:model="files_upload.{{ $i->nama_file }}" />
                                                @if (isset($files_upload[$i->nama_file]))
                                                    <br>
                                                    <button class="btn btn-block btn-primary"
                                                        wire:click.prevent="submitDokumen('{{ addslashes(json_encode($i)) }}')">Kirim
                                                        Berkas</button>
                                                @endif
                                                @error('files_upload.' . $i->nama_file)
                                                    <span class="text-danger error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="project-progress">
                                                <div class="project-progress-details">
                                                    <div class="project-progress-task"><em
                                                            class="icon ni ni-check-round-cut"></em><span>{{ $this->RiwayatDokumenUploadPemohon($i->id) }}
                                                            Riwayat Upload
                                                            Dokumen</span></div>
                                                    <div class="project-progress-percent">
                                                        {{ config('styles.loading_status_upload.' . $doktb?->status . '.v') }}%
                                                    </div>
                                                </div>
                                                <div class="progress progress-pill progress-md bg-light" wire:ignore>
                                                    <div class="progress-bar"
                                                        data-progress="{{ config('styles.loading_status_upload.' . $doktb?->status . '.v') }}">
                                                    </div>
                                                </div>
                                                <br>
                                                <a class="btn btn-block btn-dim btn-info"
                                                    href="{{ route('pemohon.pengajuan.dashboard.upload', ['id' => $i->id]) }}">Detail
                                                    Informasi</a>
                                            </div>
                                            @if ($doktb)
                                                <div class="project-meta">
                                                    <span
                                                        class="badge {{ config('styles.status_upload.' . $doktb?->status . '.class') }}">{{ config('styles.status_upload.' . $doktb?->status . '.text') }}</span>
                                                    <span class="badge badge-dim bg-primary"><em
                                                            class="icon ni ni-clock"></em><span>{{ Carbon::parse($doktb?->created_at)->diffForHumans() }}</span></span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <div class="col-lg-12">
                        <livewire:data.table-upload-dokumen-pemohon :ids="$ids" />
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card h-100">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Notifications</h6>
                            </div>
                            <div class="card-tools">
                                <a href="javascript:void(0)" class="link">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-inner">
                        <div class="timeline">
                            <h6 class="timeline-head">{{ date_today() }} </h6>
                            <ul class="timeline-list">
                                @foreach ($this->loadNotification() as $i)
                                    <li class="timeline-item">
                                        <div class="timeline-status bg-primary is-outline"></div>
                                        <div class="timeline-date">
                                            {{ Carbon::parse($i->created_at)->isoFormat('d MMM') }}<em
                                                class="icon ni ni-alarm-alt"></em></div>
                                        <div class="timeline-data">
                                            <h6 class="timeline-title">{{ $i->title }}</h6>
                                            <div class="timeline-des">
                                                <p>{{ $i->keterangan }}</p>
                                                <span
                                                    class="time">{{ Carbon::parse($i->created_at)->isoFormat('H:m a') }}</span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div><!-- .card -->
            </div>
        </div><!-- .nk-block -->
    </div>
    {{-- <div class="nk-block">
        <iframe src="https://simbg.pu.go.id/" width="100%" height="1200px" frameborder="0">
            Your browser does not support iframes.
        </iframe>
    </div> --}}
</div>
