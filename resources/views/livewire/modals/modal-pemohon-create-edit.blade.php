<div class="modal fade" tabindex="-1" id="modalsPendataanPengajuanPemohon" wire:ignore.self>
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-center modal-title center align-center">Tambah Data Pengajuan Baru</h5>
                <a href="javascript:void(0)" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <livewire:page-applicant.form-page-data-pemohon :ids="$ids" :key="$ids" />
            </div>
        </div>
    </div>
</div>
