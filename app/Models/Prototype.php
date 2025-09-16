<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Prototype extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('gambar_prototype')
            ->singleFile();

        $this->addMediaCollection('file_prototype')
            ->singleFile();
    }
    public function registerMediaConversions(Media $media = null): void
    {
        // thumbnail 300x300, crop center
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued(); // -> hapus baris ini jika ingin diproses via queue
    }
    protected $guarded = [];

    public function uploadedFile(?UploadedFile $file, string $collectionName, string $filePrefix): array
    {
        $acceptedMimeTypes = [
            'image/jpeg',
            'image/png',
            'application/pdf',
            // 'application/msword',
            // 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ];

        if ($file) {
            try {
                $extension = $file->getClientOriginalExtension();
                $mimeType = $file->getMimeType();

                if (!in_array($mimeType, $acceptedMimeTypes)) {
                    // Jika tipe mime tidak diterima, kembalikan false
                    return [
                        'status' => false,
                        'message' => "Tipe file \"$mimeType\" tidak diizinkan.",
                    ];
                }

                $newFileName = $filePrefix . '_' . time() . '_' . rand(1000, 9999) . '.' . $extension;

                $media = $this->addMedia($file)
                    ->usingFileName($newFileName)
                    ->toMediaCollection($collectionName);

                return [
                    'status' => true,
                ];
            } catch (\Throwable $th) {
                return [
                    'status' => false,
                    'message' => "Exception saat upload file: " . $th->getMessage(),
                ];
            }
        }

        return [
            'status' => true,
        ];
    }

}
