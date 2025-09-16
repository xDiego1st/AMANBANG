<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <div class="row g-3">
            <div class="col-sm-12">
                <!-- Profile Photo -->
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                        <!-- Profile Photo File Input -->
                        <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                        <x-label for="photo" value="{{ __('Photo') }}" />

                        <!-- Current Profile Photo -->
                        <div class="mt-2" x-show="! photoPreview">
                            <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                                class="rounded-circle" {{-- Bootstrap/DashLite --}}
                                style="width:80px;height:80px;object-fit:cover;">
                        </div>

                        <div class="mt-2" x-show="photoPreview" x-cloak>
                            <img :src="photoPreview" alt="Preview" class="rounded-circle"
                                style="width:80px;height:80px;object-fit:cover;">
                        </div>


                        <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                            {{ __('Select A New Photo') }}
                        </x-secondary-button>

                        @if ($this->user->profile_photo_path)
                            <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                                {{ __('Remove Photo') }}
                            </x-secondary-button>
                        @endif

                        <x-input-error for="photo" class="mt-2" />
                    </div>
                @endif
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="form-label" for="pi-nama-lengkap">Nama
                        Lengkap ( Beserta Gelar )</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" wire:model='state.name' id="pi-nama-lengkap"
                            name="pi-nama-lengkap" placeholder="Nama Lengkap" required>

                        <x-input-error for="name" class="error text-danger" />
                    </div>
                    @role(['ADMIN-KELURAHAN', 'ADMIN-KECAMATAN'])
                        <div class="badge badge-dim bg-info text-wrap">
                            Informasi: Nama Akan Dicetak Di surat
                        </div>
                    @endrole
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="form-label" for="pi-contact-wa">Contact
                        WA</label>
                    <div class="form-control-wrap">
                        <input type="number" class="form-control" wire:model='state.no_wa' id="pi-contact-wa"
                            name="pi-contact-wa" placeholder="62XXXXXXXXXX" required>
                        <x-input-error for="no_wa" class="error text-danger" />
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label class="form-label" for="pi-email">Email</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" wire:model='state.email' id="pi-email"
                            name="pi-email" placeholder="Input Your Email address" required>
                        <x-input-error for="email" class="error text-danger" />
                    </div>
                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                            !$this->user->hasVerifiedEmail())
                        <p class="mt-2 text-sm">
                            {{ __('Your email address is unverified.') }}

                            <button type="button"
                                class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                wire:click.prevent="sendEmailVerification">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if ($this->verificationLinkSent)
                            <p class="mt-2 text-sm font-medium text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    @endif
                    <div class="mt-1 badge badge-dim bg-danger text-wrap">
                        Pastikan Email Yang Tertulis Sama Dengan Email Pada SIMBG.
                    </div>

                </div>
            </div>
            <div class="col-12">
                <div x-data wire:key='{{ time() }}'>
                    <template
                        x-if="{{ isset($formdata['type_signature']) && $formdata['type_signature'] == 'SignaturePad' ? 'true' : 'false' }}">
                        <div class='card-inner'>
                            <x-custom.etc.signature-pad wire:model="signaturePad" wire:key="signature-pad" />
                            <small><span class="text-secondary">Informasi : Setelah anda
                                    membuat
                                    Tanda Tangan Digital, Harap <span class="text-danger">Menunggu Sekitar 3
                                        Detik</span> Sebelum Anda Menekan Tombol
                                    Submit</span></small>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
