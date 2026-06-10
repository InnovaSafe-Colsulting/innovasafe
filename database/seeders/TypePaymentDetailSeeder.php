<?php

namespace Database\Seeders;

use App\Models\TypePaymentDetail;
use Illuminate\Database\Seeder;

class TypePaymentDetailSeeder extends Seeder
{
    public function run(): void
    {
        $details = [
            [
                'id_payment_detail' => 1,
                'bank' => 'Bancolombia',
                'account_type' => 'Ahorros',
                'account_number' => '123-456789-00',
                'holder' => 'InnovaSafe SAS',
                'nit' => '900.123.456-7',
                'value' => 150000,
            ],
            [
                'id_payment_detail' => 3,
                'holder' => 'InnovaSafe SAS',
                'cellphone' => '312 2777482',
                'value' => 150000,
            ],
            [
                'id_payment_detail' => 4,
                'holder' => 'InnovaSafe SAS',
                'cellphone' => '312 2777482',
                'value' => 150000,
            ],
        ];

        foreach ($details as $detail) {
            TypePaymentDetail::create($detail);
        }
    }
}
