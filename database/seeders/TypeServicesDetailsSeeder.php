<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeServicesDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sstServiceId = 1; // ID del servicio "Seguridad y Salud en el Trabajo (SST)"
        
        // 7 Módulos Básicos
        $basicModules = [
            'Asignación de persona que diseñe e implemente el SG-SST.',
            'Afiliación al Sistema de Seguridad Social Integral.',
            'Capacitación en SST.',
            'Plan anual de trabajo.',
            'Evaluaciones médicas ocupacionales.',
            'Identificación de peligros; evaluación y valoración de riesgos.',
            'Medidas de prevención y control frente a los peligros/riesgos identificados.'
        ];
        
        // 3 Módulos Adicionales
        $additionalModules = [
            'Inspecciones',
            'Comité Convivencia', 
            'Vigía SST'
        ];
        
        // Insertar módulos básicos
        foreach ($basicModules as $module) {
            DB::table('type_services_detail')->insert([
                'module' => $module,
                'type_module' => 'Basico',
                'type_service_id' => $sstServiceId,
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        // Insertar módulos adicionales
        foreach ($additionalModules as $module) {
            DB::table('type_services_detail')->insert([
                'module' => $module,
                'type_module' => 'Adicional',
                'type_service_id' => $sstServiceId,
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}