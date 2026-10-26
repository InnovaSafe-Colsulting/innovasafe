<?php

namespace App\Filament\Resources\Tenants\Pages;

use App\Filament\Resources\Tenants\TenantResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateTenant extends CreateRecord
{
    protected static string $resource = TenantResource::class;

    public function getTitle(): string
    {
        return 'Crear Empresa';
    }

    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()->label('Crear');
    }

    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()->label('Crear otro');
    }
}
