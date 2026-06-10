<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StadisticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statistics = [
            ['name' => 'Años de Experiencia', 'value' => '10+'],
            ['name' => 'Empresas Asesoradas', 'value' => '200+'],
            ['name' => 'Consultores Expertos', 'value' => '15+'],
            ['name' => 'Comprometidos', 'value' => '100%'],
        ];

        DB::table('configuration_company')->insert($statistics);
    }
}
