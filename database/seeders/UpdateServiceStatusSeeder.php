<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateServiceStatusSeeder extends Seeder
{
    public function run()
    {
        // Actualizar el servicio "Control de Vigilancia" para que esté activo
        DB::table('type_services')
            ->where('name', 'LIKE', '%Control de Vigilancia%')
            ->orWhere('name', 'LIKE', '%control%vigilancia%')
            ->orWhere('name', 'LIKE', '%Vigilancia%')
            ->update(['status' => '1']);
        
        // También actualizar otros servicios comunes que podrían estar inactivos
        $servicesToActivate = [
            'Control de Vigilancia',
            'Vigilancia',
            'Control de vigilancia',
            'Sistema de Vigilancia',
            'Monitoreo y Control'
        ];
        
        foreach ($servicesToActivate as $serviceName) {
            DB::table('type_services')
                ->where('name', $serviceName)
                ->update(['status' => '1']);
        }
        
        $this->command->info('Servicios actualizados correctamente');
    }
}