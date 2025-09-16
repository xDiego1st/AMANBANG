<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Console\Commands\ClearStorage;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\StandarTargetHari;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Command Untuk Clear Storage setiap melakukan seed
        $cleanStorageCommand = new ClearStorage();
        $cleanStorageCommand->handle();

        $this->call([
            UsersSeeder::class,
            DokumenSeeder::class,
            KeteranganSeeder::class,
            PrototypeSeeder::class,
            StandarTargetHariSeeder::class,
            // DetailPemohonSeeder::class,
            // UserBLSeeder::class, //LUNA
        ]);

        //Kecamatan Seeder
        $json = File::get('database/data/data_kecamatan_pekanbaru.json');
        $data = json_decode($json);
        foreach ($data as $d) {
            Kecamatan::create([
                'id' => $d->id,
                'nama' => $d->nama,
                'dapil' => $d->dapil,
            ]);
        }

        //Kelurahan Seeder
        $json = File::get('database/data/data_kelurahan.json');
        $data = json_decode($json);
        foreach ($data as $d) {
            Kelurahan::create([
                'id' => $d->id,
                'name' => $d->name,
                'kecamatan_id' => $d->kecamatan_id,
                'kode_pos' => $d->kode_pos,
            ]);
        }
    }
}
