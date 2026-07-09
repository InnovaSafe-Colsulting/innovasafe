<?php

namespace App\Filament\Pages\Resources;

use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;

class EditResource extends Page
{
    protected string $view = 'filament.pages.recursos.edit';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public function getTitle(): string
    {
        return 'Editar Recurso';
    }

    public $resource;
    public $resourceTypes;
    public $type;

    public function mount(int $id, string $type): void
    {
        $this->type = $type;
        $this->resourceTypes = DB::table('resources_types')->get();

        $this->resource = $type === 'blog'
            ? DB::table('blog_resource_details')->where('id', $id)->first()
            : DB::table('documents_resources_details')->where('id', $id)->first();

        if (!$this->resource) {
            $this->redirect(route('filament.admin.pages.recursos-page'));
        }
    }
}
