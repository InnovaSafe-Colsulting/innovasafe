<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateClient extends CreateRecord
{
    protected static string $resource = ClientResource::class;

    public function getTitle(): string
    {
        return 'Crear Cliente';
    }

    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()->label('Crear');
    }

    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()->label('Crear otro');
    }
    
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Cliente creado con éxito';
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
    protected function afterCreate(): void
    {
        // Enviar correo de verificación
        $this->record->sendEmailVerificationNotification();
        
        // Limpiar formulario
        $this->form->fill([]);
    }
}