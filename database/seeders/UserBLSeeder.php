<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserBLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'role' => 'SUPER-ADMIN',
                'name' => 'Admin User',
                'username' => 'superadmin',
                'password' => bcrypt('admin123'), // Ganti dengan password yang sesuai
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'status_account' => 1,
                'no_wa' => '08123456789',
                'last_login_at' => null,
                'last_login_ip' => null,
                'last_seen' => null,
                'active_until' => null, // Set masa aktif 1 tahun
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'USER',
                'name' => 'Regular User',
                'username' => 'user',
                'password' => bcrypt('password123'), // Ganti dengan password yang sesuai
                'email' => 'user@example.com',
                'email_verified_at' => now(),
                'status_account' => 1,
                'no_wa' => '08198765432',
                'last_login_at' => null,
                'last_login_ip' => null,
                'last_seen' => null,
                'active_until' => now()->addHour(), // Tidak ada batas aktif
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users_bl')->insert($data);
    }
}
