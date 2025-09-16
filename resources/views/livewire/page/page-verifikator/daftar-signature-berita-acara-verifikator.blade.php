<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Daftar Pengajuan Berita Acara Pemohon</h3>
                <div class="nk-block-des text-soft">
                    <p>Anda Memiliki Total ({{ $data->total() }}) Dokumen Berita Acara Yang Perlu Disetujui.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                            class="icon ni ni-menu-alt-r"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt"><a href="https://simbg.pu.go.id/" target="_blank"
                                    class="btn btn-primary"><em class="icon ni ni-reports"></em><span>SIMBG</span></a>
                            </li>
                        </ul>
                    </div>
                </div><!-- .toggle-wrap -->
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row g-gs">
            @foreach ($data as $i)
                <div class="col-sm-12 col-lg-6 col-xxl-4">
                    <div class="card">
                        <div class="card-inner">
                            <div class="team">
                                <div class="text-white team-status bg-warning"><em class="icon ni ni-clock"></em></div>
                                <div class="team-options">
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger"
                                            data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="#"><em
                                                            class="icon ni ni-edit-fill text-danger"></em><span
                                                            class="text-danger">Edit Data</span></a></li>
                                                <li><a href="#"><em
                                                            class="icon ni ni-focus text-primary"></em><span
                                                            class="text-primary">View
                                                            Details</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-card user-card-s2">
                                    <div class="user-info">
                                        <h6>{{ $i->pengajuan->nama }}</h6>
                                        <span class="sub-text">{{ $i->pengajuan->nomor_registrasi_simbg }}</span>
                                        @php
                                            $statusMap = config('styles.status_pemohon');
                                            $st = $statusMap[$i->pengajuan->status] ?? [
                                                'text' => '-',
                                                'class' => 'bg-secondary',
                                            ];
                                        @endphp
                                        <span class="badge {{ $st['class'] }}">{{ $st['text'] }}</span>
                                    </div>
                                </div>
                                {{-- Ganti src -> data-src --}}
                                <div class="pdf-holder" x-data x-init="const el = $refs.frame;
                                const src = el.dataset.src;
                                const io = new IntersectionObserver((entries) => {
                                    entries.forEach(e => {
                                        if (e.isIntersecting) {
                                            el.src = src;
                                            io.disconnect();
                                        }
                                    });
                                }, { rootMargin: '0px 0px 300px 0px' });
                                io.observe(el);">
                                    <embed x-ref="frame"
                                        data-src="{{ route('genarate.pdf.ba', ['idpengajuan' => Crypt::encrypt($i->pengajuan->id)]) }}"
                                        type="application/pdf" width="100%" height="500px">
                                </div>


                                <hr>
                                <div class="card">
                                    <div class="card-inner">

                                        @php
                                            $p = $i->pengajuan;
                                        @endphp
                                        <div class="row g-2">
                                            {{-- Nomor Registrasi --}}
                                            <div class="col-6">
                                                <div class="team-stat-info">
                                                    <span class="sub-text"><em class="icon ni ni-hash"></em> Nomor
                                                        Registrasi</span>
                                                    <span
                                                        class="lead-text">{{ $p->nomor_registrasi_simbg ?? '-' }}</span>
                                                </div>
                                            </div>

                                            {{-- Jenis & Tim Penilai --}}
                                            <div class="col-6">
                                                <div class="team-stat-info">
                                                    <span class="sub-text"><em class="icon ni ni-briefcase"></em> Jenis
                                                        Pengajuan</span>
                                                    <span
                                                        class="badge bg-danger">{{ $p->jenis_pengajuan ?? '-' }}</span>
                                                    <span class="badge bg-primary ms-1">Tim:
                                                        {{ $p->team_penilai_ba ?? 'TPA' }}</span>
                                                </div>
                                            </div>

                                            {{-- Nama Pemohon --}}
                                            <div class="col-6">
                                                <div class="team-stat-info">
                                                    <span class="sub-text"><em class="icon ni ni-user"></em>
                                                        Pemohon</span>
                                                    <span class="lead-text">{{ $p->nama ?? '-' }}</span>
                                                </div>
                                            </div>

                                            {{-- Nomor WhatsApp --}}
                                            <div class="col-6">
                                                <div class="team-stat-info">
                                                    <span class="sub-text"><em class="icon ni ni-call"></em>
                                                        WhatsApp</span>
                                                    <span class="lead-text text-success">
                                                        @if ($p->no_wa)
                                                            <a href="https://wa.me/{{ preg_replace('/\D+/', '', $p->no_wa) }}"
                                                                target="_blank">{{ $p->no_wa }}</a>
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>

                                            {{-- Alamat --}}
                                            <div class="col-12">
                                                <div class="team-stat-info">
                                                    <span class="sub-text"><em class="icon ni ni-map-pin"></em>
                                                        Alamat</span>
                                                    <span class="lead-text">{{ $p->alamat ?? '-' }}</span>
                                                </div>
                                            </div>

                                            {{-- Lokasi Bangunan --}}
                                            <div class="col-12">
                                                <div class="team-stat-info">
                                                    <span class="sub-text"><em class="icon ni ni-building"></em> Lokasi
                                                        Bangunan</span>
                                                    <span class="lead-text">
                                                        {{ $p->lokasi_bangunan_jalan ?? '-' }}
                                                        @if ($p->lokasi_bangunan_kelurahan)
                                                            • Kel. {{ $p->lokasi_bangunan_kelurahan }}
                                                        @endif
                                                        @if ($p->lokasi_bangunan_Kecamatan)
                                                            • Kec. {{ $p->lokasi_bangunan_Kecamatan }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>

                                            {{-- Nama & Fungsi Bangunan --}}
                                            <div class="col-6">
                                                <div class="team-stat-info">
                                                    <span class="sub-text"><em class="icon ni ni-home"></em> Nama
                                                        Bangunan</span>
                                                    <span class="lead-text">{{ $p->nama_bangunan ?? '-' }}</span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="team-stat-info">
                                                    <span class="sub-text"><em class="icon ni ni-layers"></em>
                                                        Fungsi</span>
                                                    <span class="lead-text">{{ $p->fungsi_bangunan ?? '-' }}</span>
                                                </div>
                                            </div>

                                            {{-- Unit / Lantai / Luas Lahan --}}
                                            <div class="col-12">
                                                <div class="team-stat-info">
                                                    <span class="sub-text"><em class="icon ni ni-grid-alt"></em> Unit
                                                        / Lantai
                                                        / Luas Lahan</span>
                                                    <span class="lead-text">
                                                        {{ $p->jumlah_unit_kavling ?? '-' }} unit •
                                                        {{ $p->jumlah_lantai ?? '-' }} lt •
                                                        {{ $p->luas_lahan ? number_format($p->luas_lahan, 0, ',', '.') . ' m²' : '-' }}
                                                    </span>
                                                </div>
                                            </div>
                                            {{-- Nomor Surat BA --}}
                                            {{-- <div class="col-12">
                                                <div class="team-stat-info">
                                                    <span class="sub-text"><em class="icon ni ni-file-text"></em>
                                                        Nomor Surat
                                                        BA</span>
                                                    <span class="lead-text">{{ $p->nomor_surat_ba ?? '-' }}</span>
                                                </div>
                                            </div> --}}
                                        </div>

                                    </div>
                                </div>
                                <hr>
                                <div
                                    class="flex-wrap gap-2 mt-3 team-view d-flex justify-content-between align-items-center">
                                    {{-- TOLAK (tanpa wire:loading) --}}
                                    @if ($i->pengajuan->team_penilai_ba == 'TPA')
                                        @role(['VERIFIKATOR'])
                                            <a href="{{ route('pengajuan.detail.upload', ['dokId' => $user->type_validator, 'id' => Crypt::encrypt($i->pengajuan->id)]) }}"
                                                class="btn btn-dim btn-sm btn-outline-danger d-inline-flex align-items-center justify-content-center"
                                                title="Detail Data" style="min-height: 34px">
                                                <em class="icon ni ni-repeat"></em><span>Detail Data</span>
                                            </a>
                                        @endrole
                                    @else
                                        <a href="{{ route('verifikator.detail.upload.tpt', ['id' => Crypt::encrypt($i->pengajuan->id)]) }}"
                                            class="btn btn-dim btn-sm btn-outline-danger d-inline-flex align-items-center justify-content-center"
                                            title="Detail Data" style="min-height: 34px">
                                            <em class="icon ni ni-repeat"></em><span>Detail Data</span>
                                        </a>
                                    @endif

                                    {{-- SETUJUI (dengan wire:loading stabil) --}}
                                    <button type="button"
                                        wire:click.prevent="konfirmasiBA('{{ encrypt($i->pengajuan->id) }}')"
                                        wire:loading.attr="disabled" wire:target="konfirmasiBA"
                                        class="gap-1 px-4 shadow-sm btn btn-success btn-sm btn-round d-inline-flex align-items-center position-relative"
                                        style="min-height: 34px">
                                        {{-- label tidak dihapus, hanya di-invisible saat loading agar ukuran tetap --}}
                                        <span wire:loading.class="invisible" wire:target="konfirmasiBA">
                                            <em class="icon ni ni-check-circle me-1"></em> Setujui
                                        </span>
                                        {{-- spinner absolute di tengah --}}
                                        <span class="position-absolute top-50 start-50 translate-middle" wire:loading
                                            wire:target="konfirmasiBA">
                                            <span class="spinner-border spinner-border-sm"></span>
                                        </span>
                                    </button>

                                    {{-- LIHAT (buka modal fullscreen) --}}
                                    <button type="button"
                                        class="btn btn-dim btn-sm btn-outline-primary d-inline-flex align-items-center justify-content-center"
                                        data-bs-toggle="modal" data-bs-target="#modalBaPreview"
                                        data-src="{{ route('genarate.pdf.ba', ['idpengajuan' => Crypt::encrypt($i->pengajuan->id)]) }}"
                                        title="Lihat Dokumen" style="min-height: 34px">
                                        <em class="icon ni ni-eye"></em><span>Lihat</span>
                                    </button>

                                </div>

                                <br>
                            </div><!-- .team -->
                        </div><!-- .card-inner -->
                    </div><!-- .card -->
                </div><!-- .col -->
            @endforeach
            {{-- Tombol Load More (fallback, kalau user tak scroll sampai sentinel) --}}
            <div class="mt-3 text-center" @if (!$data->hasMorePages()) style="display:none" @endif>
                <button class="btn btn-primary" wire:click="loadMore" wire:loading.attr="disabled"
                    wire:target="loadMore">
                    <span wire:loading.remove wire:target="loadMore">
                        <em class="icon ni ni-reload"></em> Load more
                    </span>
                    <span wire:loading wire:target="loadMore">
                        <span class="spinner-border spinner-border-sm"></span> Memuat...
                    </span>
                </button>
            </div>

            {{-- Sentinel untuk auto-load saat discroll (IntersectionObserver via Alpine) --}}
            <div x-data x-init="// Jangan observasi kalau tidak ada halaman berikutnya
            @if ($data->hasMorePages()) const el = $refs.sentinel;
            const io = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // panggil loadMore saat sentinel terlihat
                        $wire.loadMore();
                    }
                });
            }, { root: null, rootMargin: '0px 0px 300px 0px', threshold: 0 });
            io.observe(el); @endif" class="py-3">
                @if ($data->hasMorePages())
                    <div x-ref="sentinel" class="text-center text-soft small">
                        <em class="icon ni ni-more-h"></em> Gulir ke bawah untuk memuat data...
                    </div>
                @else
                    <div class="text-center text-soft small">
                        <em class="icon ni ni-check-thick"></em> Semua data sudah ditampilkan.
                    </div>
                @endif
            </div>

            {{-- Overlay loading ringan saat fetch berikutnya --}}
            <div wire:loading.flex wire:target="loadMore" class="my-3 justify-content-center">
                <div class="spinner-border" role="status" aria-hidden="true"></div>
                <span class="ms-2">Memuat data berikutnya...</span>
            </div>
        </div>
    </div><!-- .nk-block -->
    <div class="nk-block">
        <livewire:data.table-permohonan-k-r-k :type_view='2' />
    </div>
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
