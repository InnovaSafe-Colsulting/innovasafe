<?php

namespace App\Filament\Resources\TypeServiceResource\Pages;

use App\Filament\Resources\TypeServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypeService extends EditRecord
{
    protected static string $resource = TypeServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
    
    protected function getSavedNotificationTitle(): ?string
    {
        return 'Servicio actualizado con éxito';
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}