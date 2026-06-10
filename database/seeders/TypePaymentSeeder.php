<?php

namespace Database\Seeders;

use App\Models\TypePayment;
use Illuminate\Database\Seeder;

class TypePaymentSeeder extends Seeder
{
    public function run(): void
    {
        $payments = [
            ['name' => 'Efecty'],
            ['name' => 'Consignación Bancaria'],
            ['name' => 'PayU'],
            ['name' => 'Nequi'],
            ['name' => 'Daviplata'],
        ];

        foreach ($payments as $payment) {
            TypePayment::create($payment);
        }
    }
}
