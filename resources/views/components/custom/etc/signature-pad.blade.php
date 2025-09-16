@props([
    'width' => 400, // default width dalam px
    'height' => 200, // default height dalam px
])

<div x-data="signaturePad(@entangle($attributes->wire('model')))" x-show="show" class="w-full max-w-lg mx-auto">
    <canvas x-ref="signature_canvas" class="block mx-auto border rounded shadow"></canvas>

    {{-- Tombol-tombol aksi --}}
    <div class="mx-auto space-y-2">
        <button type="button" @click="clear()" class="mt-1 btn btn-outline-secondary btn-block">
            Clear
        </button>
    </div>
</div>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('signaturePad', (model) => ({
                signaturePadInstance: null,
                value: model,
                show: true,

                // agar bisa dipanggil ulang
                resizeCanvas: null,

                init() {
                    const canvas = this.$refs.signature_canvas
                    const ctx = canvas.getContext('2d')

                    // 1. Definisikan resizeCanvas sebagai method komponen
                    this.resizeCanvas = () => {
                        const ratio = Math.max(window.devicePixelRatio || 1, 1)
                        const w = canvas.offsetWidth
                        const h = canvas.offsetHeight

                        canvas.width = w * ratio
                        canvas.height = h * ratio
                        canvas.style.width = w + 'px'
                        canvas.style.height = h + 'px'

                        ctx.setTransform(1, 0, 0, 1, 0, 0)
                        ctx.scale(ratio, ratio)

                        if (this.signaturePadInstance) {
                            this.signaturePadInstance.clear()
                            if (this.value) this.loadSignature(this.value)
                        }
                    }

                    // 2. Panggil saat init dan saat window resize
                    window.addEventListener('resize', this.resizeCanvas)
                    this.resizeCanvas()

                    // 3. Inisialisasi SignaturePad
                    this.signaturePadInstance = new SignaturePad(canvas, {
                        minWidth: 4, // default 0.5, makin besar makin tebal
                        maxWidth: 6.5, // default 2.5
                        penColor: 'black' // bisa ganti ke warna lain kalau perlu
                    })

                    if (this.value) this.loadSignature(this.value)

                    // 4. Simpan ke Livewire saat endStroke
                    this.signaturePadInstance.addEventListener('endStroke', () => {
                        this.value = this.signaturePadInstance.toDataURL('image/png')
                    })

                    // 5. Watch `show` agar resize ulang saat ditampilkan
                    this.$watch('show', visible => {
                        if (visible) this.$nextTick(this.resizeCanvas)
                    })
                },

                loadSignature(base64) {
                    const canvas = this.$refs.signature_canvas
                    const ctx = canvas.getContext('2d')
                    const img = new Image()
                    img.onload = () => {
                        ctx.clearRect(0, 0, canvas.width, canvas.height)
                        ctx.drawImage(img, 0, 0, canvas.width, canvas.height)
                    }
                    img.src = base64
                },

                clear() {
                    this.signaturePadInstance.clear()
                    this.value = null
                },

                close() {
                    this.show = false
                },

                save() {
                    if (this.signaturePadInstance.isEmpty()) {
                        alert('Tanda tangan masih kosong.')
                        return
                    }
                    const base64 = this.signaturePadInstance.toDataURL('image/png')
                    // contoh popup
                    const w = window.open('', '_blank')
                    w.document.write(`<img src="${base64}" style="max-width:100%;">`)
                    w.document.close()
                },

                destroy() {
                    // cleanup jika perlu
                    window.removeEventListener('resize', this.resizeCanvas)
                    if (this.signaturePadInstance) {
                        this.signaturePadInstance.off()
                        this.signaturePadInstance = null
                    }
                }

            }))
        })
    </script>
@endpush
