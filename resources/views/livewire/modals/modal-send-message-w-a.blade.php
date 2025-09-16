<div class="modal fade" tabindex="-1" id="modalsSendMessageWa" wire:ignore.self>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-center modal-title center align-center">Kirim Pesan WhatsApp Ke Pemohon #
                    @if (isset($pemohon))
                        {{ $pemohon->name ?? convertPhoneNumber($pemohon->no_wa) }}
                    @endif
                </h5>
                <a href="javascript:void(0)" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="row g-gs">
                    <div class="col-12">
                        <span class="overline-title">Isi Pesan</span>
                        <div class="form-group">
                            <label class="form-label" for="isi_pesan_whatsapp">Pesan Whatsapp</label>

                            <span class="text-danger"><em class="icon ni ni-info-i"></em></span>
                            <textarea type="text" class="form-control" id="isi_pesan_whatsapp"
                                placeholder="Informasi Aplikasi Manajemen Bangunan Gedung (AMANBANG)....." wire:model.live='isi_pesan_whatsapp'></textarea>
                            @error('isi_pesan_whatsapp')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button wire:click.prevent='submit' type="button"
                                class="btn btn-primary btn-lg btn-block">Submit
                                Data</button>
                        </div>
                    </div>
                </div><!-- .row -->
            </div>
        </div>
    </div>
</div>
