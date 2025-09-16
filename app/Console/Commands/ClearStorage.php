<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ClearStorage extends Command
{
    protected $signature = 'clear:storage';
    protected $description = 'Clear the contents of the storage directory';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Hapus isi direktori storage

        Storage::deleteDirectory('livewire-tmp'); // Sesuaikan dengan struktur direktori storage Anda
        // Storage::makeDirectory('livewire-tmp'); // Buat direktori kembali

        Storage::deleteDirectory('public'); // Sesuaikan dengan struktur direktori storage Anda
        // Storage::makeDirectory('public/uploads'); // Buat direktori kembali
        // Storage::makeDirectory('public/file-excel'); // Buat direktori kembali
        Storage::deleteDirectory('media-library'); // Sesuaikan dengan struktur direktori storage Anda
        Storage::deleteDirectory('uploads'); // Sesuaikan dengan struktur direktori storage Anda
        // Storage::makeDirectory('media-library'); // Buat direktori kembali

        // Bersihkan cache Laravel
        \Artisan::call('view:clear');
        \Artisan::call('cache:clear');
        \Artisan::call('config:cache');

        // Cek jika output tersedia
        if ($this->output) {
            // Cetak pesan ke output
            $this->info('Storage directory cleared.');
        } else {
            // Jika output tidak tersedia, gunakan 'echo' sebagai alternatif
            echo "Storage directory cleared." . PHP_EOL;
        }
    }
}
