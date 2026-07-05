<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use UnitEnum;

class RecursosCrearPage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFolderOpen;

    protected string $view = 'filament.pages.recursos.create';

    protected static ?string $navigationLabel = 'Recursos';

    protected static ?string $title = 'Crear Recurso';

    protected static bool $shouldRegisterNavigation = false;

    public $resourceTypes = [];

    public function mount(): void
    {
        $this->resourceTypes = DB::table('resources_types')->get()->toArray();
    }
}
