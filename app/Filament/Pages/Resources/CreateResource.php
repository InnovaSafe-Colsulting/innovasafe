<?php

namespace App\Filament\Pages\Resources;

use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;

class CreateResource extends Page
{
    protected string $view = 'filament.pages.recursos.create';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public function getTitle(): string
    {
        return 'Crear Recurso';
    }

    public $resourceTypes;

    public function mount(): void
    {
        $this->resourceTypes = DB::table('resources_types')->get();
    }
}
