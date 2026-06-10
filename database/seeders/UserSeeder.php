<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('role', 'Administrador')->first();
        $bogota = City::where('name', 'Bogotá')->first();

        User::create([
            'names' => 'Wilmar',
            'last_names' => 'Guerrero',
            'city_id' => $bogota->id,
            'address' => 'Calle 100 #15-20',
            'neighboarhood' => 'Chicó',
            'cellphone' => '3001234567',
            'email' => 'wilmar.guerrero@innovasafe.com',
            'password' => Hash::make('password123'),
            'role_id' => $adminRole->id,
            'status' => '1',
        ]);
    }
}
