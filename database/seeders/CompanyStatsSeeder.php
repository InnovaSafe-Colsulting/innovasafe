<?php

namespace Database\Seeders;

use App\Models\ConfigurationCompany;
use Illuminate\Database\Seeder;

class CompanyStatsSeeder extends Seeder
{
    public function run()
    {
        $stats = [
            'Años de Experiencia' => '10+',
            'Empresas Asesoradas' => '200+',
            'Consultores Expertos' => '15+',
            'Comprometidos' => '100%',
            'Control de vigilancia' => '24/7', // Actualizar este valor
            'description' => 'Ofrecemos soluciones integrales en Seguridad y Salud en el Trabajo, Calidad, Gestión Ambiental y Transformación Digital.',
            'email' => 'info@innovasafe.com',
            'cellphone' => '300 123 4567',
        ];

        foreach ($stats as $name => $value) {
            ConfigurationCompany::updateOrCreate(
                ['name' => $name],
                ['value' => $value, 'status' => '1']
            );
        }
    }
}