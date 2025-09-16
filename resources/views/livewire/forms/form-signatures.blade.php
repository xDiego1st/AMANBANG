<form class="is-alter">
    @csrf
    <div class="card-inner-group">
        <div class="card-inner">
            @foreach ($fields as $section_name => $section_data)
                {{-- Judul kategori --}}
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between align-items-center">
                        <div class="nk-block-head-content w-100">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-1 nk-block-title text-primary d-flex align-items-center">
                                    <em class="icon ni ni-file-text me-2"></em>{{ $section_name }}
                                </h5>
                                <span class="badge rounded-pill bg-primary">
                                    {{ count($fields) }} Data
                                </span>
                            </div>
                            <p class="mb-0 text-muted small">
                                {{ $section_data['description'] }}
                            </p>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="col-lg-12">
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="nk-fmg-listing nk-block-lg">
                                <div class="nk-block-head-xs">
                                    <div class="nk-block-between g-2">
                                        <div class="nk-block-head-content">
                                            <h6 class="nk-block-title overline-title">Daftar Berkas Yang Di Uploads</h6>
                                        </div>
                                        <div class="nk-block-head-content">
                                            <ul class="nk-block-tools g-3 nav" role="tablist">
                                                <li><a data-bs-toggle="tab" href="#file-list-view"
                                                        class="nk-switch-icon active" aria-selected="true"
                                                        role="tab"><em class="icon ni ni-view-row-wd"></em></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
                                <div class="tab-content">
                                    <div class="tab-pane active show" id="file-list-view" role="tabpanel">
                                        <div class="nk-files nk-files-view-list">
                                            @php
                                                $mediaItems = $user->getMedia('signature');
                                            @endphp

                                            @foreach ($mediaItems as $index => $media)
                                                @php
                                                    // dd($media->getFullUrl());
                                                    $isImage = Str::startsWith($media->mime_type, 'image/');
                                                    $modalId = 'previewSignatureModal_' . $index;
                                                    // Jika punya conversion 'thumb', gunakan itu agar ringan
                                                    $thumbUrl =
                                                        $isImage &&
                                                        method_exists($media, 'hasGeneratedConversion') &&
                                                        $media->hasGeneratedConversion('thumb')
                                                            ? $media->getUrl('thumb')
                                                            : $media->getFullUrl();
                                                @endphp

                                                <div class="nk-file-item nk-file">
                                                    <div class="nk-file-info">
                                                        <div class="nk-file-title d-flex align-items-center">

                                                            {{-- HANYA tampilkan ikon untuk non-gambar --}}
                                                            @unless ($isImage)
                                                                <div class="nk-file-icon me-2">
                                                                    <span class="nk-file-icon-type">
                                                                        @if ($media->mime_type === 'application/pdf')
                                                                            <em class="icon ni ni-file-pdf"></em>
                                                                        @else
                                                                            <em class="icon ni ni-file"></em>
                                                                        @endif
                                                                    </span>
                                                                </div>
                                                            @endunless

                                                            <div class="gap-2 nk-file-name d-flex align-items-center">
                                                                {{-- Jika gambar: tampilkan thumbnail, tanpa ikon --}}
                                                                @if ($isImage)
                                                                    <a href="javascript:void(0)" class="d-inline-block"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#{{ $modalId }}"
                                                                        data-toggle="modal"
                                                                        data-target="#{{ $modalId }}">
                                                                        <img src="{{ $thumbUrl }}"
                                                                            alt="Signature {{ $index + 1 }}"
                                                                            class="img-thumbnail"
                                                                            style="width: 96px; height: 96px; object-fit: cover;">
                                                                    </a>
                                                                @endif

                                                                {{-- Judul/link untuk memicu modal (gambar & non-gambar) --}}
                                                                <div class="nk-file-name-text">
                                                                    <a href="javascript:void(0)" class="title"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#{{ $modalId }}"
                                                                        data-toggle="modal"
                                                                        data-target="#{{ $modalId }}">
                                                                        File Signature {{ $index + 1 }}
                                                                    </a>
                                                                    <div class="sub-text small text-muted">
                                                                        {{ $media->file_name }} •
                                                                        {{ $media->mime_type }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- .nk-file -->

                                                {{-- MODAL PREVIEW --}}
                                                <div class="modal fade" id="{{ $modalId }}" tabindex="-1"
                                                    role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">Preview:
                                                                    {{ $media->file_name }}</h6>
                                                                <button type="button" class="close btn btn-sm btn-icon"
                                                                    data-bs-dismiss="modal" aria-label="Close"
                                                                    data-dismiss="modal">
                                                                    <em class="icon ni ni-cross"></em>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if ($isImage)
                                                                    {{-- Preview Gambar --}}
                                                                    <img src="{{ $media->getFullUrl() }}"
                                                                        alt="Preview" class="img-fluid w-100"
                                                                        style="max-height: 70vh; object-fit: contain;">
                                                                @elseif ($media->mime_type === 'application/pdf')
                                                                    {{-- Preview PDF --}}
                                                                    <iframe src="{{ $media->getFullUrl() }}"
                                                                        width="100%" height="600"
                                                                        style="border:0;"></iframe>
                                                                @else
                                                                    {{-- Fallback non-gambar/non-pdf --}}
                                                                    <div class="mb-0 alert alert-info">
                                                                        Preview tidak tersedia untuk tipe file ini.
                                                                        <br>
                                                                        <a href="{{ $media->getFullUrl() }}"
                                                                            target="_blank"
                                                                            class="mt-2 btn btn-primary btn-sm">Download
                                                                            / Buka di tab baru</a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="{{ $media->getFullUrl() }}" target="_blank"
                                                                    class="btn btn-primary">Buka
                                                                    Asli</a>
                                                                <button type="button" class="btn btn-light"
                                                                    data-bs-dismiss="modal"
                                                                    data-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>

                                    </div><!-- .tab-pane -->
                                </div><!-- .tab-content -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-2 bg-white nk-block">
                    <div class="row">
                        @include('components.custom.forms.DinamisForm')
                        <div x-data wire:key='{{ time() }}'>
                            <template
                                x-if="{{ isset($formdata['type_signature']) && $formdata['type_signature'] == 'SignaturePad' ? 'true' : 'false' }}">
                                <div class='card-inner'>
                                    <x-custom.etc.signature-pad wire:model="signaturePad" wire:key="signature-pad" />
                                    <small><span class="text-secondary">Informasi : Setelah anda
                                            membuat
                                            Tanda Tangan Digital, Harap <span class="text-danger">Menunggu Sekitar
                                                3
                                                Detik</span> Sebelum Anda Menekan Tombol
                                            Submit</span></small>
                                </div>
                            </template>
                        </div>

                    </div>
                </div>
            @endforeach
            @if (isset($formdata['type_signature']))
                <div class="p-3 col-12">
                    <div class="form-group">
                        <button wire:click.prevent="submit" wire:loading.attr="disabled" wire:target="submit"
                            type="button"
                            class="btn {{ count($mediaItems) > 0 ? 'btn-secondary' : 'btn-primary' }} btn-lg btn-block">
                            <span wire:loading.remove wire:target="submit">
                                {{ count($mediaItems) > 0 ? 'Save' : 'Submit' }}
                            </span>
                            <span wire:loading wire:target="submit">
                                <i class="spinner-border spinner-border-sm"></i> Memproses...
                            </span>
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</form>
