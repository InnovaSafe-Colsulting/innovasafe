<?php

namespace Database\Seeders;

use App\Models\TypeService;
use Illuminate\Database\Seeder;

class TypeServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Seguridad y Salud en el Trabajo (SST)',
                'description' => 'Gestiona la Seguridad y Salud en el Trabajo de forma integral, cumpliendo la normativa vigente.',
                'video_url' => 'public/videos/SST2.mp4',
            ],
            [
                'name' => 'Gestión de Calidad',
                'description' => 'Optimiza tus procesos y asegura la calidad en cada actividad de tu organización.',
            ],
            [
                'name' => 'Gestión Ambiental',
                'description' => 'Administra tus aspectos ambientales, controla impactos y promueve la sostenibilidad.',
            ],
            [
                'name' => 'Control de Vigilancia',
                'description' => 'Control de vigilancia para sitios en los que no solo la seguridad es la importancia, sino tener el control de tu vigilancia.',
            ],
            [
                'name' => 'Gestion de Bares',
                'description' => 'Queremos que tu bar, discoteca o sitio de rumba, pueda ser gestionado y tener el control de todos los escenarios.',
            ],
            [
                'name' => 'Consultoría',
                'description' => 'En InnovaSafe Consulting SAS ofrecemos un servicio integral de consultoría en Seguridad y Salud en el Trabajo diseñado para ayudar a las empresas a implementar, fortalecer y mantener un Sistema de Gestión SG-SST eficiente, moderno y alineado con la normatividad colombiana vigente.',
                'video_url' => 'public/videos/Consultoria.mp4',
            ],
        ];

        foreach ($services as $service) {
            TypeService::create($service);
        }
    }
}
