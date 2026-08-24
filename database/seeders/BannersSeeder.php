<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('banners')->insert([
            [
                'name'       => 'SST-Web',
                'position'   => 1,
                'image'      => 'images/banners/Banner_Web.jpeg',
                'movil'      => '0',
                'status'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'SST-Movil',
                'position'   => 1,
                'image'      => 'images/banners/Banner_Movil.jpeg',
                'movil'      => '1',
                'status'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
