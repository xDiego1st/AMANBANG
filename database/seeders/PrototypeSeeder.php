<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prototype;
use Illuminate\Support\Facades\DB;

class PrototypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'Rumah Tinggal Sederhana Tipe 36',
                'type' => 'Tipe 36',
                'category' => '1',
            ],
            [
                'title' => 'Rumah Tinggal Sederhana Tipe 38',
                'type' => 'Tipe 38',
                'category' => '2',
            ],
        ];

        // insert data prototypes
        DB::table('prototypes')->insert($data);

        // Ambil semua prototype
        $dokumenList = Prototype::all();

        // Lokasi file contoh
        $file_prototype = base_path('database/template/Prototipe - Rumah Tinggal Sederhana Tipe 36 PP.pdf');
        $gambar_prototype = base_path('database/template/hunian-sederhana-tipe-36.jpg');

        foreach ($dokumenList as $prototype) {
            // Upload PDF ke collection "file_prototype"
            if (file_exists($file_prototype)) {
                $prototype
                    ->addMedia($file_prototype)
                    ->preservingOriginal()
                    ->toMediaCollection('file_prototype');
            }

            // Upload gambar ke collection "gambar_prototype"
            if (file_exists($gambar_prototype)) {
                $prototype
                    ->addMedia($gambar_prototype)
                    ->preservingOriginal()
                    ->toMediaCollection('gambar_prototype');
            }
        }
    }
}
