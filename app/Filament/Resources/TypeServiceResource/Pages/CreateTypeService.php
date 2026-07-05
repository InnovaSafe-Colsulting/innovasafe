<?php

namespace App\Filament\Resources\TypeServiceResource\Pages;

use App\Filament\Resources\TypeServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreateTypeService extends CreateRecord
{
    protected static string $resource = TypeServiceResource::class;
    
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Servicio creado con éxito';
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
    protected function handleRecordCreation(array $data): Model
    {
        // Extraer módulos del JSON si existen
        $modules = [];
        if (isset($data['modules']) && is_string($data['modules'])) {
            $modules = json_decode($data['modules'], true) ?? [];
        }
        
        // Limpiar datos antes de crear el servicio
        unset($data['modules']);
        
        // Crear el servicio
        $service = parent::handleRecordCreation($data);
        
        // Guardar los módulos en type_services_detail
        if (!empty($modules)) {
            foreach ($modules as $module) {
                DB::table('type_services_detail')->insert([
                    'type_service_id' => $service->id,
                    'module' => $module['name'],
                    'type_module' => $module['type'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
        
        return $service;
    }
}