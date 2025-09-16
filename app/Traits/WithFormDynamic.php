<?php
namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;

// use Illuminate\Support\Str;

trait WithFormDynamic
{
    #[Locked]
    public $fields = [];
    #[Locked]
    public $field_details = [];
    public $formdata = [];

    private function convertBase64ToUploadedFile(string $base64): UploadedFile
    {
        // Pisahkan metadata dan konten base64
        if (preg_match('/^data:(.*);base64,(.*)$/', $base64, $matches)) {
            $mimeType = $matches[1]; // contoh: image/png, application/pdf
            $base64Data = $matches[2];
        } else {
            throw new \Exception('Format base64 tidak valid.');
        }

        // Decode isi base64
        $fileContent = base64_decode($base64Data);

        // Tentukan ekstensi berdasarkan MIME type
        $extension = explode('/', $mimeType)[1] ?? 'tmp';

        // Nama file sementara
        $tempFileName = 'upload-' . time() . '.' . $extension;

        // Simpan file ke storage lokal sementara
        Storage::disk('local')->put($tempFileName, $fileContent);

        // Path file fisik
        $filePath = Storage::disk('local')->path($tempFileName);

        // Buat dan kembalikan instance UploadedFile
        return new UploadedFile(
            $filePath,
            $tempFileName,
            $mimeType,
            null, // error
            true// test mode
        );
    }
    public function shouldDisplayField($field_name)
    {
        // Check if the field has required_if validation
        foreach ($this->fields as $section) {
            if (isset($section['fields'][$field_name])) {
                $rules = $section['fields'][$field_name];
                if (is_string($rules)) {
                    $rules = explode('|', $rules);
                }

                foreach ($rules as $rule) {
                    if (Str::startsWith($rule, 'required_if:')) {
                        $params = explode(',', str_replace('required_if:', '', $rule));
                        $targetField = $params[0] ?? null;
                        $expectedValue = $params[1] ?? null;

                        if (
                            $targetField &&
                            $expectedValue &&
                            isset($this->formdata[$targetField]) &&
                            $this->formdata[$targetField] == $expectedValue
                        ) {
                            return true;
                        }

                        return false;
                    }
                }
            }
        }

        // If no conditional logic found, always display the field
        return true;
    }
    public function isFieldRequired($field_name)
    {
        foreach ($this->fields as $section) {
            if (isset($section['fields'][$field_name])) {
                $rules = $section['fields'][$field_name];

                if (is_string($rules)) {
                    $rules = explode('|', $rules);
                }

                foreach ($rules as $rule) {
                    // Cek apakah rule langsung required
                    if ($rule === 'required') {
                        return true;
                    }

                    // Cek jika required_if
                    if (Str::startsWith($rule, 'required_if:')) {
                        $params = explode(',', str_replace('required_if:', '', $rule));
                        $targetField = $params[0] ?? null;
                        $expectedValue = $params[1] ?? null;

                        if (
                            $targetField &&
                            $expectedValue &&
                            isset($this->formdata[$targetField]) &&
                            $this->formdata[$targetField] == $expectedValue
                        ) {
                            return true;
                        }
                    }
                }
            }
        }

        return false;
    }

    //=======================================

    protected function rules()
    {
        $rules = [];
        $rules = $this->buildRule();
        return $rules;
    }

    protected function validationAttributes()
    {
        $attributes = [];
        $attributes = $this->buildAttr();
        return $attributes;
    }
    private function initializeFormData()
    {
        foreach ($this->fields as $section => $data) {
            foreach ($data['fields'] as $field_name => $validation) {
                if (!isset($this->formdata[$field_name])) {
                    $this->formdata[$field_name] = null;
                }
            }
        }
    }
    public function buildRule()
    {
        $rules = [];

        foreach ($this->fields as $categoryData) {
            if (!isset($categoryData['fields']) || !is_array($categoryData['fields'])) {
                continue;
            }

            foreach ($categoryData['fields'] as $fieldName => $validationRules) {
                $fieldRules = [];

                if (is_string($validationRules)) {
                    $fieldRules = explode('|', $validationRules);
                } elseif (is_array($validationRules)) {
                    foreach ($validationRules as $rule) {
                        if (is_string($rule) && class_exists($rule)) {
                            $fieldRules[] = app($rule);
                        } else {
                            $fieldRules[] = $rule;
                        }
                    }
                }

                // Cek kondisi jika ids terisi dan field file
                if ($this->ids && $this->isFileField($fieldRules)) {
                    // Ubah 'required' menjadi 'sometimes'
                    $fieldRules = array_map(function ($rule) {
                        return $rule === 'required' ? 'sometimes' : $rule;
                    }, $fieldRules);
                }

                $rules["formdata.{$fieldName}"] = $fieldRules;
            }
        }

        return $rules;
    }

    #[Computed]
    public function buildAttr()
    {
        $attributes = [];
        foreach ($this->field_details as $nama_field => $detail) {
            $attributes["formdata.{$nama_field}"] = $detail['label'];
        }
        return $attributes;
    }
    protected function isFileField(array $fieldRules): bool
    {
        foreach ($fieldRules as $rule) {
            if (is_string($rule) && (Str::contains($rule, 'file') || Str::contains($rule, 'mimes'))) {
                return true;
            }
        }
        return false;
    }

}
