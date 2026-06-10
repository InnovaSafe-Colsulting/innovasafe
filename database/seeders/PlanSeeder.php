<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plans')->insert([
            [
                'id' => 1,
                'name' => 'Plan Starter',
                'description' => 'Para empresas entre 1 y 3 colaboradores.',
                'access' => '1',
                'prize' => 197900,
                'basic_modules' => null,
                'additional_modules' => null,
                'discount' => 0,
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Plan Beginners',
                'description' => 'Para empresas entre 4 y 6 colaboradores.',
                'access' => '1',
                'prize' => 297900,
                'basic_modules' => null,
                'additional_modules' => null,
                'discount' => 0,
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Plan Growth',
                'description' => 'Para empresas entre 7 y 10 colaboradores.',
                'access' => '1',
                'prize' => 397900,
                'basic_modules' => null,
                'additional_modules' => null,
                'discount' => 0,
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Plan Business',
                'description' => 'Para empresas entre 11 y 20 colaboradores.',
                'access' => '1',
                'prize' => 649900,
                'basic_modules' => null,
                'additional_modules' => null,
                'discount' => 0,
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Plan Corporate',
                'description' => 'Para empresas entre 21 y 50 colaboradores.',
                'access' => '1',
                'prize' => 997900,
                'basic_modules' => null,
                'additional_modules' => null,
                'discount' => 0,
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Plan Personalize',
                'description' => 'Para empresas con mas de 50 colaboradores.',
                'access' => '1',
                'prize' => 0,
                'basic_modules' => null,
                'additional_modules' => null,
                'discount' => 0,
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
