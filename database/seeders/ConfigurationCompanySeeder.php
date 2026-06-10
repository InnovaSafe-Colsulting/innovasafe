<?php

namespace Database\Seeders;

use App\Models\ConfigurationCompany;
use Illuminate\Database\Seeder;

class ConfigurationCompanySeeder extends Seeder
{
    public function run(): void
    {
        $configs = [
            ['name' => 'email', 'value' => 'servicioalcliente@innovasafeconsulting.com'],
            ['name' => 'cellphone', 'value' => '312 2777482'],
            ['name' => 'description', 'value' => 'Impulsamos organizaciones seguras, eficientes y sostenibles a través de soluciones integrales en SST, Calidad y Gestión Ambiental.'],
            ['name' => 'contact_solutions', 'value' => json_encode([
                ['label' => 'SG-SST', 'icon' => '<svg class="w-6 h-6 text-[#39bf24] mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>'],
                ['label' => 'Calidad', 'icon' => '<svg class="w-6 h-6 text-[#39bf24] mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'],
                ['label' => 'Ambiental', 'icon' => '<svg class="w-6 h-6 text-[#39bf24] mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'],
                ['label' => 'Control Seguridad', 'icon' => '<svg class="w-6 h-6 text-[#39bf24] mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>'],
                ['label' => 'Gestion Bares', 'icon' => '<svg class="w-6 h-6 text-[#39bf24] mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18l-2 13H5L3 3zm0 0l1 1m16-1l-1 1M9 22h6M12 16v6"/></svg>'],
            ])],
        ];

        foreach ($configs as $config) {
            ConfigurationCompany::create($config);
        }
    }
}
