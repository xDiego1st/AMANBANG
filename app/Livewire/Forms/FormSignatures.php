<?php

namespace App\Livewire\Forms;

use App\Traits\WithCustomTraits;
use App\Traits\WithFormDynamic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormSignatures extends Component
{
    use WithFormDynamic;
    use WithCustomTraits;
    use WithFileUploads;
    #[Locked]
    public $ids, $data, $uniqueId;
    public $signaturePad;
    public function mount()
    {
        $this->uniqueId = $this->id();
        $this->setFieldsData();
        $this->initializeFormData();
    }
    public function render()
    {
        return view('livewire.forms.form-signatures');
    }
    private function setFieldsData()
    {
        $this->fields = [
            'Data Signature' => [
                'description' => 'Data Tanda Tangan Digital Anda Untuk Keperluan Pengabsahan Berkas',
                'fields' => [
                    'type_signature' => 'required|string|max:255',
                    'file_signature' => 'required_if:type_signature,File|nullable|file|mimes:jpeg,png,jpg|max:1024',
                    'pad_signature' => 'required_if:type_signature,SignaturePad',
                ],
            ],
        ];
        $this->field_details = [
            'type_signature' => [
                'label' => 'Tipe Signature',
                'desc' => 'File / SignaturePad',
                'type' => 'select',
                'data_select' => [
                    ['label' => 'File', 'value' => 'File'],
                    ['label' => 'SignaturePad', 'value' => 'SignaturePad'],
                ],
                'class' => 'mb-3 col-xxl-12 col-md-6',
            ],
            'file_signature' => [
                'label' => 'File Signature',
                'desc' => 'File Signature | Max File Size : 1.00 MB | Just Allowed : jpeg,png',
                'type' => 'file',
                'class' => 'mb-3 col-xxl-12 col-md-6',
            ],
            'pad_signature' => [
                'label' => 'Pad Signature',
                'desc' => 'Tulis Tanda Tangan Langsung di Canva',
                'type' => 'signature',
                'class' => 'mb-3 col-xxl-12 col-md-6',
            ],
        ];
    }

    // #[On('confirmedAction')]
    public function submit()
    {
        if ($this->formdata['type_signature'] == 'File') {
            $this->formdata['pad_signature'] = null;
        } else {
            $this->formdata['file_signature'] = null;
            $this->formdata['pad_signature'] = $this->signaturePad;
        }
        $this->validate();
        $user = Auth::user();
        try {
            DB::beginTransaction();
            if ($this->formdata['type_signature'] == "File") {
                $uploadedFile = $this->formdata["file_signature"];
            } else {
                $signedPdfBase64 = $this->formdata['pad_signature'];
                $uploadedFile = $this->convertBase64ToUploadedFile($signedPdfBase64);
            }
            $user->status_account = 1; // hassignature
            $tryupload = $user->uploadedFile($uploadedFile, "signature", "sign");
            if (!$tryupload['status']) {
                DB::rollBack();
                $msg = $tryupload['message'] ?? 'File Signature gagal diupload. Silakan coba lagi!';
                return $this->alertMessage('error', title: 'GAGAL MENGUPLOAD FILE', text: $msg);
            }
            $user->save();
            DB::commit();
            $user->refresh();
            $this->dispatch('clearFileInputs');
            $this->dispatch('resetSelect');
            $this->alertMessage('success', 'Data Tanda Tangan Berhasil Didaftarkan #' . $user->name, text: 'Data Tanda Tangan Berhasil Terdaftar Di Sistem AMANBANG dengan aman', timer: 4000);

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            Log::error($th->getMessage());
            $this->alertMessage('error', 'GAGAL', $th->getMessage());
        }
    }
}
