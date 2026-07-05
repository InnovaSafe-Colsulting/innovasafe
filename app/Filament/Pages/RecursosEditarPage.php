<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\DB;
use UnitEnum;

class RecursosEditarPage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFolderOpen;

    protected string $view = 'filament.pages.recursos.edit';

    protected static ?string $navigationLabel = 'Recursos';

    protected static ?string $title = 'Editar Recurso';

    protected static bool $shouldRegisterNavigation = false;

    public $resourceTypes = [];
    public $resource = null;
    public $type = '';
    public int $id = 0;

    public function mount(): void
    {
        $this->id   = (int) request('id');
        $this->type = (string) request('type');

        $this->resourceTypes = DB::table('resources_types')->get()->toArray();

        if ($this->type === 'blog') {
            $this->resource = DB::table('blog_resource_details')->where('id', $this->id)->first();
        } else {
            $this->resource = DB::table('documents_resources_details')->where('id', $this->id)->first();
        }

        if (!$this->resource) {
            $this->redirect(route('filament.admin.pages.recursos-page'));
        }
    }
}
