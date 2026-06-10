<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            ['name' => 'Colombia'],
            ['name' => 'México'],
            ['name' => 'Argentina'],
            ['name' => 'Brasil'],
            ['name' => 'Chile'],
            ['name' => 'Perú'],
            ['name' => 'España'],
            ['name' => 'Estados Unidos'],
            ['name' => 'Canadá'],
            ['name' => 'Ecuador'],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
