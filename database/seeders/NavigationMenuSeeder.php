<?php

namespace Database\Seeders;

use App\Models\NavigationMenu;
use Illuminate\Database\Seeder;

class NavigationMenuSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['label' => 'Inicio', 'url' => '/', 'position' => 0, 'status' => '1'],
            ['label' => 'Servicios', 'url' => '/servicios', 'position' => 1, 'status' => '1'],
            ['label' => 'Nosotros', 'url' => '/nosotros', 'position' => 2, 'status' => '1'],
            ['label' => 'Recursos', 'url' => '/recursos', 'position' => 3, 'status' => '1'],
            ['label' => 'Contacto', 'url' => '/contacto', 'position' => 4, 'status' => '1'],
        ];

        foreach ($items as $item) {
            NavigationMenu::create($item);
        }
    }
}
