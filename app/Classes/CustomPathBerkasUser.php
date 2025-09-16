<?php
namespace App\Classes;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathBerkasUser implements PathGenerator
{
    // Helper: base path unik per media
    protected function base(Media $media): string
    {
        $userId  = $media->model->getKey(); // id user
        $mediaId = $media->getKey();        // id media (aman dipakai di v10)
        return "u{$userId}/{$mediaId}/";
    }

    // File asli
    public function getPath(Media $media): string
    {
        return $this->base($media);
    }

    // Konversi (thumb, dll.)
    public function getPathForConversions(Media $media): string
    {
        return $this->base($media) . 'conversions/';
    }

    // Responsive images
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->base($media) . 'responsive/';
    }
}
