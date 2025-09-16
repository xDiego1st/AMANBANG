 <div class="nk-content ">
     <div class="container-fluid">
         <div class="nk-content-inner">
             <div class="nk-content-body">
                 <div class="nk-block-head nk-block-head-sm">
                     <div class="nk-block-between g-3">
                         <div class="nk-block-head-content">
                             <h3 class="nk-block-title page-title">Desain Prototipe/Purwarupa</h3>
                             <div class="nk-block-des text-soft">
                                 <p>Terdapat <span class="text-base">1</span> Desain Prototipe/Purwarupa Yang Bisa
                                     Anda Download.</p>
                             </div>
                         </div>

                         @role(['ADMIN'])
                             <div class="nk-block-head-content">
                                 <x-custom.wirebtn method="startAdd" label="Tambah Prototype"
                                     class="btn-primary btn btn-block" icon="ni-plus" />
                             </div>
                         @endrole
                     </div>
                 </div><!-- .nk-block-head -->
                 <div class="nk-block">
                     {{-- Tombol Tambah --}}
                     <div class="row g-gs">
                         @foreach ($this->getDataPrototype() as $item)
                             @php
                                 $gambar = $item->getFirstMediaUrl('gambar_prototype') ?? asset('images/no_image.png');
                                 $pdf = $item->getFirstMediaUrl('file_prototype');
                             @endphp

                             <div class="col-sm-6 col-lg-4 col-xxl-3" wire:key="proto-{{ $item->id }}">
                                 <div class="gallery card">
                                     {{-- Thumbnail --}}
                                     <a class="gallery-image popup-image" href="{{ $gambar }}">
                                         <img class="w-100 rounded-top" src="{{ $gambar }}" alt="Prototype">
                                     </a>

                                     <div class="card-inner">
                                         {{-- Baris tombol edit & hapus --}}
                                         <div class="mb-2 d-flex justify-content-between">
                                             @role(['ADMIN'])
                                                 <button class="btn btn-sm btn-outline-primary"
                                                     wire:click="startEdit({{ $item->id }})">
                                                     <em class="icon ni ni-edit"></em>
                                                 </button>
                                                 <button class="btn btn-sm btn-outline-danger"
                                                     wire:click="confirmDelete({{ $item->id }})">
                                                     <em class="icon ni ni-trash"></em>
                                                 </button>
                                             @endrole
                                         </div>

                                         <div class="text-center">
                                             <ul class="product-tags">
                                                 <li><span class="badge bg-outline-info">{{ $item->type }}</span></li>
                                             </ul>
                                             <h5 class="product-title">
                                                 <a href="#" tabindex="0">{{ $item->title }}</a>
                                             </h5>

                                             {{-- Tombol lihat PDF --}}
                                             @if ($pdf)
                                                 <button class="btn btn-block btn-outline-dark" data-bs-toggle="modal"
                                                     data-bs-target="#modalPdf{{ $item->id }}">
                                                     Lihat
                                                 </button>
                                             @else
                                                 <button class="btn btn-block btn-outline-secondary" disabled>
                                                     Tidak Ada File
                                                 </button>
                                             @endif
                                         </div>
                                     </div>
                                 </div>
                             </div>

                             {{-- Modal Preview PDF (per item) --}}
                             @if ($pdf)
                                 <div class="modal fade" tabindex="-1" id="modalPdf{{ $item->id }}"
                                     wire:ignore.self>
                                     <div class="modal-dialog modal-xl" role="document">
                                         <div class="modal-content">
                                             <div class="modal-header">
                                                 <h5 class="modal-title">Preview File Prototype</h5>
                                                 <button type="button" class="btn-close"
                                                     data-bs-dismiss="modal"></button>
                                             </div>
                                             <div class="modal-body" style="height: 80vh;">
                                                 <iframe src="{{ $pdf }}" frameborder="0" width="100%"
                                                     height="100%"></iframe>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             @endif
                         @endforeach
                     </div>

                     {{-- Modal Edit (global, pakai Livewire Form) --}}
                     <x-custom.modal id="modalUpsert" title="{{ $editId ? 'Edit Prototype' : 'Tambah Prototype' }}">
                         <form wire:submit.prevent="saveUpsert">
                             <div class="modal-body">
                                 <div class="mb-2">
                                     <label class="form-label">Judul</label>
                                     <input class="form-control" wire:model.defer="form.title">
                                     @error('form.title')
                                         <small class="text-danger">{{ $message }}</small>
                                     @enderror
                                 </div>
                                 <div class="mb-2">
                                     <label class="form-label">Tipe</label>
                                     <input class="form-control" wire:model.defer="form.type">
                                     @error('form.type')
                                         <small class="text-danger">{{ $message }}</small>
                                     @enderror
                                 </div>
                                 <div class="mb-2">
                                     <label class="form-label">Kategori</label>
                                     <input class="form-control" wire:model.defer="form.category">
                                     @error('form.category')
                                         <small class="text-danger">{{ $message }}</small>
                                     @enderror
                                 </div>
                                 <div class="col-lg-12">
                                     <span class="badge badge-md bg-info text-wrap btn-block">Gambar Muka Prototype</span>
                                     <hr>
                                     <x-filepond::upload wire:model="form.upload_gambar" required />
                                     @error('form.upload_gambar')
                                         <span class="text-danger error">{{ $message }}</span>
                                     @enderror
                                 </div>
                                 <div class="col-lg-12">
                                     <span class="badge badge-md bg-primary text-wrap btn-block">File Prototype</span>
                                     <hr>
                                     <x-filepond::upload wire:model="form.upload_prototype" required />
                                     @error('form.upload_prototype')
                                         <span class="text-danger error">{{ $message }}</span>
                                     @enderror
                                 </div>
                             </div>
                             <div class="modal-footer">
                                 <button class="btn btn-light" type="button" data-bs-dismiss="modal">Batal</button>
                                 <button class="btn btn-primary" type="submit">Simpan</button>
                             </div>
                         </form>
                     </x-custom.modal>

                     {{-- Modal Konfirmasi Hapus (global) --}}
                     <x-custom.modal id="modalDelete" title="Hapus Prototype">
                         <div class="modal-body">
                             <p>Data & media akan dihapus. Yakin?</p>
                         </div>
                         <div class="modal-footer">
                             <button class="btn btn-light" type="button" data-bs-dismiss="modal">Batal</button>
                             <button class="btn btn-danger" type="button"
                                 wire:click="deleteConfirmed">Hapus</button>
                         </div>
                     </x-custom.modal>
                 </div><!-- .nk-block -->
             </div>
         </div>
     </div>
 </div>
