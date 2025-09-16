<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'role' => 'SUPER-ADMIN', // Pemantauan Infrastuktur
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'email' => 'rasyidmasterphoenix@gmail.com',
                'password' => bcrypt('@adm1n123'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'no_wa' => '6281270622264',
            ], [
                'role' => 'ADMIN',
                'name' => 'OPERATOR AMANBANG',
                'username' => 'operator',
                'email' => 'Operator@gmail.com',
                'password' => bcrypt('@Pekanbaru123-'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'no_wa' => '6281270622264',
            ],
        ];
        $data_verifikator = [
            [
                'role' => 'VERIFIKATOR',
                'name' => 'Dr. Doddy Anwar S.T.,MM.,MT.IAI.AA',
                'type_validator' => '1',
                'jenis_user' => 'TPA',
                'username' => 'verifikator1',
                'email' => 'verifikator1@gmail.com',
                'password' => bcrypt('verifikator123'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'no_wa' => '6281270622264',
            ], [
                'role' => 'VERIFIKATOR',
                'name' => 'Prof. Dr.Ir.H. Sugeng Wiyono,MMT',
                'type_validator' => '2',
                'jenis_user' => 'TPA',
                'username' => 'verifikator2',
                'email' => 'verifikator2@gmail.com',
                'password' => bcrypt('verifikator123'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'no_wa' => '6281270622264',
            ], [
                'role' => 'VERIFIKATOR',
                'name' => 'Amir Hamzah, S.T,MT',
                'type_validator' => '3',
                'jenis_user' => 'TPA',
                'username' => 'verifikator3',
                'email' => 'verifikator3@gmail.com',
                'password' => bcrypt('verifikator123'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'no_wa' => '6281270622264',
            ],
        ];
        $data_pengawas = [
            [
                'role' => 'PENGAWAS',
                'name' => 'TUSWAN AIDI, ST, MT',
                'nip' => '197404052009031002',
                'username' => 'pengawas1',
                'email' => 'pengawas1@gmail.com',
                'password' => bcrypt('pengawas123'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'no_wa' => '6281270622264',
            ], [
                'role' => 'PENGAWAS',
                'name' => 'ARDIANSYAH,ST',
                'nip' => '197311162006041016',
                'username' => 'pengawas2',
                'email' => 'pengawas2@gmail.com',
                'password' => bcrypt('pengawas123'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'no_wa' => '6281270622264',
            ],
        ];
        $data_tpt = [
            'role' => 'VERIFIKATOR',
            'name' => 'Kholijah Hasibuan,ST',
            'nip' => '199206192024212009',
            'type_validator' => '5',
            'jenis_user' => 'TPT',
            'username' => 'verifikatortpt',
            'email' => 'verifikatortpt@gmail.com',
            'password' => bcrypt('verifikator123'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'no_wa' => '6281270622264',
        ];
        DB::table('users')->insert($data);
        DB::table('users')->insert($data_verifikator);
        DB::table('users')->insert($data_pengawas);
        DB::table('users')->insert($data_tpt);

        // $dataPemohon = [[
        //     'role' => 'PEMOHON',
        //     'name' => 'ANDI',
        //     'username' => 'pemohon1',
        //     'jenis_pengajuan' => 'PBG',
        //     'team_penilai_ba' => 'TPA',
        //     'nomor_registrasi_simbg' => 'PBG-147109-04042023-01',
        //     'email' => 'pemohon_pbg@gmail.com',
        //     'password' => bcrypt('pemohon123'),
        //     'email_verified_at' => now(),
        //     'remember_token' => Str::random(10),
        //     'no_wa' => '6281270622264',
        //     'jenis_konsultasi_bangunan' => "Rumah Tinggal Tidak Sederhana",
        // ], [
        //     'role' => 'PEMOHON',
        //     'name' => 'RASYID',
        //     'username' => 'pemohon2',
        //     'jenis_pengajuan' => 'SLF',
        //     'team_penilai_ba' => 'TPT',
        //     'nomor_registrasi_simbg' => 'SLF-147109-04042023-01',
        //     'email' => 'pemohon_slf@gmail.com',
        //     'password' => bcrypt('pemohon123'),
        //     'email_verified_at' => now(),
        //     'remember_token' => Str::random(10),
        //     'no_wa' => '6281270622264',
        //     'jenis_konsultasi_bangunan' => "Rumah Tinggal Sederhana",
        // ],
        // ];
        // foreach ($dataPemohon as $v) {
        //     $user = User::create([
        //         'role' => $v['role'],
        //         'name' => $v['name'],
        //         'username' => $v['username'],
        //         'email' => $v['email'],
        //         'password' => $v['password'],
        //         'email_verified_at' => $v['email_verified_at'],
        //         'remember_token' => $v['remember_token'],
        //         'no_wa' => $v['no_wa'],
        //     ]);
        //     $detailpemohon = DetailPemohon::create([
        //         'nomor_registrasi_simbg' => $v['nomor_registrasi_simbg'],
        //         'user_id' => $user->id,
        //         'nama' => $user->name,
        //         'no_wa' => $user->no_wa,
        //         'jenis_pengajuan' => $v['jenis_pengajuan'],
        //         // 'jenis_permohonan' => $this->jenis_permohonan,
        //         'team_penilai_ba' => $v['team_penilai_ba'],
        //         'jenis_konsultasi_bangunan' => $v['jenis_konsultasi_bangunan'],
        //         'alamat' => '-',
        //         'pekerjaan' => '-',
        //         'bertindak_atas_nama' => '-',
        //         'jabatan' => '-',
        //         'lokasi_bangunan_jalan' => '-',
        //         'lokasi_bangunan_kelurahan' => '-',
        //         'lokasi_bangunan_Kecamatan' => '-',
        //         'fungsi_bangunan' => '-',
        //         'nama_bangunan' => '-',
        //         'jumlah_unit_kavling' => 1,
        //         'jumlah_lantai' => 1,
        //         'luas_lahan' => 1,
        //         'permanensi_bangunan' => 'PERMANEN',
        //     ]);
        // }
    }
}
