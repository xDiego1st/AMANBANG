<?php
namespace App\Classes;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
    public function getPath(Media $media): string
    {
        // Folder: prototype/1/
        return strtolower(class_basename($media->model)) . '/' . $media->model->getKey() . '/';
    }

    public function getPathForConversions(Media $media): string
    {
        // Folder untuk hasil konversi (misal thumbnail)
        return $this->getPath($media) . 'conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        // Folder untuk responsive images
        return $this->getPath($media) . 'responsive/';
    }
}
