<div class="modal fade" tabindex="-1" id="modalsUploadKRKPemohon" wire:ignore.self>
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-center modal-title center align-center">Konfirmasi Pengajuan KRK / Registrasi Pemohon
                </h5>
                <a href="javascript:void(0)" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                @if ($ids)
                    <livewire:forms.form-upload-k-r-k :ids="$ids" :key="$ids" />
                @endif
                {{-- @livewire('forms.form-upload-krk', ['ids' => $ids], key($ids)) --}}
            </div>
        </div>
    </div>
</div>
