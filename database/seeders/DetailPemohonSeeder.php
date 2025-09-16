<?php

namespace Database\Seeders;

use App\Models\DetailPemohon;
use Illuminate\Database\Seeder;

class DetailPemohonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetailPemohon::create([
            'user_id' => '3',
            'nomor_registrasi_simbg' => 'PBG-147109-04042023-01',
            'nama' => 'Meily Elven Nora',
            'no_wa' => '6281270622264',
            'jenis_pengajuan' => 'PBG',
        ]);
    }
}
