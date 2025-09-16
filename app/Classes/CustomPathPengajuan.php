<?php
namespace App\Classes;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathPengajuan implements PathGenerator
{
    public function getPath(Media $media): string
    {
                                                 // Mendapatkan ID perusahaan dari model LayananPengesahanPP
        $pengajuan_id = $media->model->getKey(); // Mengambil ID pengguna dari model
        $model        = $media->model;           // Model yang berelasi
        $userId       = $model->user_id;      // Mengambil ID perusahaan

        // Menghasilkan path berdasarkan ID perusahaan
        return "user_{$userId}/berkas_pengajuan_{$pengajuan_id}/";
    }

    public function getPathForConversions(Media $media): string
    {
        // Path untuk konversi
        return $this->getPath($media) . 'conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        // Path untuk responsive images
        return $this->getPath($media) . 'responsive/';
    }
}
