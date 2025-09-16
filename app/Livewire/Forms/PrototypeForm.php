<?php

namespace App\Livewire\Forms;

use App\Models\Prototype;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class PrototypeForm extends Form
{
    public ?Prototype $model = null;

    // field text
    public string $title = '';
    public string $type = '';
    public string $category = '';

    // field file (boleh null saat edit)
    /** @var TemporaryUploadedFile|null */
    public $upload_gambar = null;

    /** @var TemporaryUploadedFile|null */
    public $upload_prototype = null;

    // set data dari model -> isi form (untuk edit)
    public function set(Prototype $prototype): void
    {
        $this->model = $prototype;
        $this->fill($prototype->only('title', 'type', 'category'));
        $this->upload_gambar = null;
        $this->upload_prototype = null;
    }

    public function rules(): array
    {
        // saat create = required, saat edit = nullable
        $isEdit = (bool) $this->model;

        return [
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:100'],
            'category' => ['required', 'string', 'max:100'],

            // gambar
            'upload_gambar' => array_filter([
                $isEdit ? 'nullable' : 'required',
                'image', // cek image secara umum
                'mimes:jpg,jpeg,png,webp',
                'max:1024', // KB = 1MB
            ]),

            // pdf
            'upload_prototype' => array_filter([
                $isEdit ? 'nullable' : 'required',
                'file',
                'mimes:pdf',
                'max:2048', // KB = 2MB
            ]),
        ];
    }

    // simpan perubahan + upload media
    public function persist(): Prototype
    {
        $this->validate();

        // create/update record
        if ($this->model) {
            $this->model->update($this->only('title', 'type', 'category'));
        } else {
            $this->model = Prototype::create($this->only('title', 'type', 'category'));
        }

        // upload gambar jika ada file baru
        if ($this->upload_gambar instanceof TemporaryUploadedFile) {
            $this->model->uploadedFile($this->upload_gambar, 'gambar_prototype', 'gambar');
        }

        // upload pdf jika ada file baru
        if ($this->upload_prototype instanceof TemporaryUploadedFile) {
            $this->model->uploadedFile($this->upload_prototype, 'file_prototype', 'file');
        }

        return $this->model->refresh();
    }
}
