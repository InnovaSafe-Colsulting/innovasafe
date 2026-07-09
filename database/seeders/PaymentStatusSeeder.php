<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentStatusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payment_status')->insert([
            ['name' => 'Pago Exitoso', 'color' => 'green',  'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pago Pendiente', 'color' => 'yellow', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Moroso',        'color' => 'red',    'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
