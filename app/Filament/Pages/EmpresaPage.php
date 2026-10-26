<?php

namespace App\Filament\Pages;

use App\Filament\Resources\Tenants\TenantResource;
use Filament\Pages\Page;

class EmpresaPage extends Page
{
    protected string $view = 'filament.pages.coming-soon';

    public function mount(): void
    {
        redirect()->to(TenantResource::getUrl())->send();
    }
}
