<?php

namespace App\Filament\Resources\TypeServiceResource\Pages;

use App\Filament\Resources\TypeServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

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
}