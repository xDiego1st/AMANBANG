<?php

namespace Database\Seeders;

use App\Models\WebSettings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Facebook',
                'type' => 'link',
                'data' => '-',
            ],
            [
                'name' => 'Twitter',
                'type' => 'link',
                'data' => '-',
            ],
            [
                'name' => 'Instagram',
                'type' => 'link',
                'data' => '-',
            ],
            [
                'name' => 'Linkedln',
                'type' => 'link',
                'data' => '-',
            ],
            [
                'name' => 'Youtube',
                'type' => 'link',
                'data' => '-',
            ],
            [
                'name' => 'Maintenance',
                'type' => 'feature',
                'data' => '0',
            ],
            [
                'name' => 'Email',
                'type' => 'value',
                'data' => '-',
            ],
            [
                'name' => 'Phone',
                'type' => 'value',
                'data' => '-',
            ],
            [
                'name' => 'Address',
                'type' => 'value',
                'data' => '-',
            ],
            [
                'name' => 'Site Copyright',
                'type' => 'value',
                'data' => '-',
            ],
            [
                'name' => 'Site Name',
                'type' => 'value',
                'data' => '-',
            ],
            [
                'name' => 'Logo',
                'type' => 'value',
                'data' => '-',
            ],
        ];
        foreach ($data as $d) {
            WebSettings::create([
                'name' => $d['name'],
                'type' => $d['type'],
                'data' => $d['data'],
            ]);
        }
    }
}
