<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StandarTargetHariSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'SOP Verifikasi & Penerbitan KRK Pemohon',
                'sop_hari' => '3',
                'desc' => 'Untuk Pernebitan KRK',
            ],
            [
                'name' => 'SOP Verifikasi Dokumen Pemohon Verifikator',
                'sop_hari' => '5',
                'desc' => 'standar sop verifikator',
            ], [
                'name' => 'SOP Perbaikan Dokumen Pemohon',
                'sop_hari' => '3',
                'desc' => 'standar sop perbaikan dokumen pemohon',
            ], [
                'name' => 'SOP Verifikasi Pengawas',
                'sop_hari' => '3',
                'desc' => 'Untuk Penerbitan BA',
            ],
        ];
        // insert data prototypes
        DB::table('standar_target_hari')->insert($data);
    }
}
