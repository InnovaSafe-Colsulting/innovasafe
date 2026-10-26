<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('plans')->insert([
            [
                'id'             => 1,
                'name'           => 'Plan Starter',
                'slug'           => 'plan-starter',
                'description'    => 'Para empresas entre 1 y 3 colaboradores.',
                'price'          => 197900,
                'currency'       => 'COP',
                'billing_period' => 'annual',
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'id'             => 2,
                'name'           => 'Plan Beginners',
                'slug'           => 'plan-beginners',
                'description'    => 'Para empresas entre 4 y 6 colaboradores.',
                'price'          => 297900,
                'currency'       => 'COP',
                'billing_period' => 'annual',
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'id'             => 3,
                'name'           => 'Plan Growth',
                'slug'           => 'plan-growth',
                'description'    => 'Para empresas entre 7 y 10 colaboradores.',
                'price'          => 397900,
                'currency'       => 'COP',
                'billing_period' => 'annual',
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'id'             => 4,
                'name'           => 'Plan Business',
                'slug'           => 'plan-business',
                'description'    => 'Para empresas entre 11 y 20 colaboradores.',
                'price'          => 649900,
                'currency'       => 'COP',
                'billing_period' => 'annual',
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'id'             => 5,
                'name'           => 'Plan Corporate',
                'slug'           => 'plan-corporate',
                'description'    => 'Para empresas entre 21 y 50 colaboradores.',
                'price'          => 997900,
                'currency'       => 'COP',
                'billing_period' => 'annual',
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'id'             => 6,
                'name'           => 'Plan Personalize',
                'slug'           => 'plan-personalize',
                'description'    => 'Para empresas con más de 50 colaboradores.',
                'price'          => 0,
                'currency'       => 'COP',
                'billing_period' => 'custom',
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}
