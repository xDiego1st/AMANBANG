<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

trait LivewireTemporaryFileCleanup
{
    public function cleanTemporaryFiles($maxAgeInSeconds = 1800)
    {
        //default 3600 detik = 1 jam
        // Hapus file-file temporari yang melewati waktu tertentu
        collect(Storage::files('livewire-tmp'))
            ->filter(function ($path) use ($maxAgeInSeconds) {
                return now()->diffInSeconds(
                    Carbon::createFromTimestamp(Storage::lastModified($path))
                ) > $maxAgeInSeconds;
            })
            ->each(function ($path) {
                Storage::delete($path);
            });
    }
}
