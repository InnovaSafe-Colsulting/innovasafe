<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['role' => 'Administrador'],
            ['role' => 'Visitante'],
            ['role' => 'Cliente'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
