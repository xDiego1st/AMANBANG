<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">{{ $data->jenis_pengajuan ?? '-' }} / <strong
                        class="text-primary small">{{ $data->nama ?? '-' }}</strong>
                </h3>
                <div class="nk-block-des text-soft">
                    <ul class="list-inline">
                        <li>Nomor Registrasi SIMBG: <span class="text-base">{{ $data?->nomor_registrasi_simbg }}</span>
                        </li>
                        <li>Diajukan Pada Tanggal: <span
                                class="text-base">{{ Carbon::parse($data->created_at)->isoFormat('dddd | D MMMM Y, h:mm a') }}</span>
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
                <div class="card">
                    <div class="card-inner">
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
                                        <div class="data-value">{{ $data->nama }}</div>
                                    </div>
                                </li>
                                <li class="data-item">
                                    <div class="data-col">
                                        <div class="data-label">Email</div>
                                        <div class="data-value text-info">
                                            {{ $data->user->email }}
                                        </div>
                                    </div>
                                </li>
                                <li class="data-item">
                                    <div class="data-col">
                                        <div class="data-label">Nomor Whatsapp</div>
                                        <div class="data-value text-primary">
                                            {{ convertPhoneNumber($data->no_wa) }}
                                        </div>
                                    </div>
                                </li>
                                <li class="data-item">
                                    <div class="data-col">
                                        <div class="data-label">Nomor Registrasi SIMBG</div>
                                        <div class="data-value">
                                            {{ $data->nomor_registrasi_simbg }}
                                        </div>
                                    </div>
                                </li>
                                <li class="data-item">
                                    <div class="data-col">
                                        <div class="data-label">Status Pengajuan</div>
                                        <div class="data-value">
                                            <span
                                                class="badge badge-dim badge-sm {{ config('styles.status_pemohon.' . $data->status . '.class') }}">
                                                {{ config('styles.status_pemohon.' . $data->status . '.text') }}
                                            </span>
                                            {{-- <span class="badge bg-outline-danger">{{ $data->jenis_pengajuan }}</span>
                                            <span
                                                class="badge bg-outline-info">{{ $data->type_dokumen->nama_dokumen }}</span> --}}
                                        </div>
                                    </div>
                                </li>
                                <li class="data-item">
                                    <div class="data-col">
                                        <div class="data-label">Last Updated</div>
                                        <div class="data-value badge badge-dim bg-outline-primary">
                                            <small>
                                                {{ convert_date2($data->updated_at) }}
                                            </small>
                                        </div>
                                    </div>
                                </li>
                                <li class="data-item">
                                    <div class="data-col">
                                        <div class="data-label">Jenis Konsultasi</div>
                                        <div class="data-value text-info">
                                            {{ $data->jenis_konsultasi_bangunan }}
                                        </div>
                                    </div>
                                </li>
                                <li class="data-item">
                                    <div class="data-col">
                                        <div class="data-label">Lokasi Bangunan</div>
                                        <div class="data-value text-info">
                                            {{ $data->lokasi_bangunan_jalan . ', ' . $data->lokasi_bangunan_kelurahan . ', ' . $data->lokasi_bangunan_Kecamatan }}
                                        </div>
                                    </div>
                                </li>
                                <li class="data-item">
                                    <div class="data-col">
                                        <div class="data-label">Fungsi Bangunan</div>
                                        <div class="data-value text-info">
                                            {{ $data->fungsi_bangunan }}
                                        </div>
                                    </div>
                                </li>
                                <li class="data-item">
                                    <div class="data-col">
                                        <div class="data-label">Luas,Tinggi & Jumlah Lantai</div>
                                        <div class="data-value text-info">
                                            {{ ($data->luas_lahan ?? '1') . ' m2' . ' dan berjumlah ' . ($data->jumlah_lantai ?? '1') . ' lantai' }}
                                        </div>
                                    </div>
                                </li>

                                <li class="data-item">
                                    <div class="data-col">
                                        <div class="data-label">Permanensi Bangunan</div>
                                        <div class="data-value text-info">
                                            {{ $data->permanensi_bangunan }}
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div><!-- .card -->
                    </div>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h5 class="nk-block-title title">Uploaded Documents</h5>
                                <p>Data Dokumen Yang sudah Di-upload</p>
                            </div>
                        </div><!-- .nk-block-head -->
                        <div class="card card-bordered">
                            <ul class="data-list is-compact">
                                @foreach ($this->loadDokumen() as $b)
                                    @php
                                        $history = $data->LatestDokumenUser($b->id);
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
                                                            style="padding-left:10px;padding-top:10px; display: flex; flex-wrap: nowrap; align-items: center;">
                                                            <div style="display: flex; flex-wrap: nowrap;">
                                                                <a href="#" target="_blank"
                                                                    class="btn btn-outline-primary"
                                                                    style="flex-shrink: 0; white-space: nowrap; min-width: auto; padding: 0px 25px; font-size: 12px;">
                                                                    <em class="icon ni ni-eye text-info"></em>
                                                                </a>

                                                                <a href="#" class="btn btn-primary"
                                                                    style="flex-shrink: 0; white-space: nowrap; min-width: auto; padding: 0px 25px; font-size: 12px;">
                                                                    <em class="text-white icon ni ni-download"></em>
                                                                </a>
                                                                <span
                                                                    class="badge badge-md badge-dim {{ config('styles.status_upload.' . $history->status . '.class') }}">{{ config('styles.status_upload.' . $history->status . '.text') }}
                                                                </span>
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

                                <li class="data-item">
                                    <div class="data-col">
                                        <div class="data-label">File Permohonan KRK Pemohon</div>
                                        <div class="data-value">
                                            @if ($data->hasMedia('upload_syarat_krk'))
                                                @php
                                                    $media = $data->getFirstMedia('upload_syarat_krk');
                                                @endphp
                                                <a href="{{ $media->getFullUrl() }}" target="_blank"
                                                    class="btn btn-outline-primary"
                                                    style="flex-shrink: 0; white-space: nowrap; min-width: auto; padding: 0px 25px;margin-left: 0.65rem; font-size: 12px;">
                                                    <em class="icon ni ni-eye text-info"></em>
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
                                            @if ($data->hasMedia('krk'))
                                                @php
                                                    $media = $data->getFirstMedia('krk');
                                                @endphp
                                                <a href="{{ $media->getFullUrl() }}" target="_blank"
                                                    class="btn btn-outline-primary"
                                                    style="flex-shrink: 0; white-space: nowrap; min-width: auto; padding:0px 25px;margin-left: 0.65rem; font-size: 12px;">
                                                    <em class="icon ni ni-eye text-info"></em>
                                                </a>
                                            @else
                                                KRK Belum Diterbitkan
                                            @endif

                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div><!-- .card -->

                    </div>
                </div>
            </div><!-- .col -->
            <div class="col-lg-7">
                <div class="row gy-5">
                    <div class="card-bordered">
                        <div id="faqs" class="accordion">
                            @foreach ($this->loadDokumen() as $dok)
                                @php
                                    $history = $data->LatestDokumenUser($dok->id);
                                @endphp
                                <div class="accordion-item">
                                    <a href="javascript:void(0)" class="accordion-head" data-bs-toggle="collapse"
                                        data-bs-target="#faq-q{{ $dok->id }}">
                                        <h6 class="title">{{ $dok->nama_dokumen }}
                                            <span
                                                class="badge badge-md badge-dim {{ config('styles.status_upload.' . $history->status . '.class') }}">{{ config('styles.status_upload.' . $history->status . '.text') }}
                                            </span>
                                        </h6>
                                        <span class="accordion-icon"></span>
                                    </a>
                                    <div class="accordion-body collapse {{ $history->status == '0' || $history->status == '1' ? 'show' : '' }}"
                                        id="faq-q{{ $dok->id }}" data-bs-parent="#faqs">
                                        <div class="accordion-inner">
                                            @livewire('forms.form-verifikator', ['id' => $data->id, 'type_dok' => $dok->id])
                                        </div>
                                    </div>
                                </div><!-- .accordion-item -->
                            @endforeach
                        </div><!-- .accordion -->
                    </div>
                </div>
            </div>
        </div><!-- .row -->
        <hr>
    </div><!-- .nk-block -->

    @livewire('modals.modal-detail-keterangan-catatan-dokumen')
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
