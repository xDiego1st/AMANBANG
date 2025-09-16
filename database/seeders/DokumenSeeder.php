<?php

namespace Database\Seeders;

use App\Models\DokumenPemohon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_dokumen' => 'Dokumen Arsitektur & Tata Bangunan', // Pemantauan Infrastuktur
                'nama_file' => 'upload_arsitektur',
                'keterangan_dokumen' => 'Dokumen Arsitektur & Tata Bangunan',
            ], [
                'nama_dokumen' => 'Dokumen Struktur Bangunan', // Pemantauan Infrastuktur
                'nama_file' => 'upload_struktur',
                'keterangan_dokumen' => 'Dokumen Struktur Bangunan',
            ], [
                'nama_dokumen' => 'Dokumen MEP', // Pemantauan Infrastuktur
                'nama_file' => 'upload_mep',
                'keterangan_dokumen' => 'Dokumen MEP',
            ],
        ];
        DB::table('dokumen_pemohons')->insert($data);
    }
}
