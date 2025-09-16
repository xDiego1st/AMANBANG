<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KeteranganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'persyaratan' => 'Gambar Rencana Fondasi',
                'dokumen_type_id' => '2',
                'kode' => 'gambar_rencana_fondasi',
            ],
            [
                'persyaratan' => 'Gambar Rencana Kolom',
                'dokumen_type_id' => '2',
                'kode' => 'gambar_rencana_kolom',
            ],
            [
                'persyaratan' => 'Gambar Rencana Balok',
                'dokumen_type_id' => '2',
                'kode' => 'gambar_rencana_balok',
            ],
            [
                'persyaratan' => 'Gambar Rencana Rangka Atap',
                'dokumen_type_id' => '2',
                'kode' => 'gambar_rencana_rangka_atap',
            ],
            [
                'persyaratan' => 'Gambar Detail Stuktur',
                'dokumen_type_id' => '2',
                'kode' => 'gambar_detail_struktur',

            ],
            [
                'persyaratan' => 'Perhitungan Teknis Sementara',
                'dokumen_type_id' => '2',
                'kode' => 'perhitungan_teknis_sementara',
            ],
            [
                'persyaratan' => 'Gambar Rencana Plat Lantai',
                'dokumen_type_id' => '2',
                'kode' => 'gambar_rencana_plat_lantai',
            ],
            [
                'persyaratan' => 'Gambar Situasi',
                'dokumen_type_id' => '1',
                'kode' => 'gambar_situasi',

            ],
            [
                'persyaratan' => 'Gambar Rencana Tapak',
                'dokumen_type_id' => '1',
                'kode' => 'gambar_rencana_tapak',
            ],
            [
                'persyaratan' => 'Gambar Denah',
                'dokumen_type_id' => '1',
                'kode' => 'gambar_denah',
            ],
            [
                'persyaratan' => 'Gambar Potongan',
                'dokumen_type_id' => '1',
                'kode' => 'gambar_potongan',
            ],
            [
                'persyaratan' => 'Gambar Tampak',
                'dokumen_type_id' => '1',
                'kode' => 'gambar_tampak',
            ],
            [
                'persyaratan' => 'Gambar Detail Arsitektur',
                'dokumen_type_id' => '1',
                'kode' => 'gambar_detail_arsitektur',
            ],
            [
                'persyaratan' => 'Spesifikasi Teknis',
                'dokumen_type_id' => '1',
                'kode' => 'spesifikasi_teknis',
            ],
            [
                'persyaratan' => 'Tata Bangunan',
                'dokumen_type_id' => '1',
                'kode' => 'tata_bangunan',
            ],
            [
                'persyaratan' => 'Gambar Rencana dan Perhitungan Teknis Jaringan Listrik',
                'dokumen_type_id' => '3',
                'kode' => 'gambar_rencana_dan_perhitungan_teknis_jaringan_listrik',
            ],
            [
                'persyaratan' => 'Gambar Rencana dan Perhitungan Sistem Sanitasi',
                'dokumen_type_id' => '3',
                'kode' => 'gambar_rencana_dan_perhitungan_sistem_sanitasi',
            ],
        ];
        \DB::table('jenis_keterangan_pemohons')->insert($data);
    }
}
