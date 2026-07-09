<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;

class ResourcesManagementPage extends Page
{
    protected string $view = 'filament.pages.resources-management-page';

    public function getTitle(): string
    {
        return 'Gestión de Recursos';
    }

    public static function getNavigationLabel(): string
    {
        return 'Gestión de Recursos';
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-folder-open';
    }

    public $resources;

    public function mount()
    {
        $documentResources = DB::table('documents_resources_details')
            ->join('resources_types', 'documents_resources_details.resource_type_id', '=', 'resources_types.id')
            ->select(
                'documents_resources_details.id',
                'documents_resources_details.title',
                DB::raw('NULL as description'),
                DB::raw('NULL as link'),
                DB::raw('NULL as image'),
                'documents_resources_details.path',
                'resources_types.resource as type_name',
                'documents_resources_details.status',
                'documents_resources_details.created_at',
                'documents_resources_details.updated_at',
                DB::raw("'document' as source_table")
            );

        $blogResources = DB::table('blog_resource_details')
            ->select(
                'id',
                'title',
                'description',
                'url_link as link',
                'image',
                DB::raw('NULL as path'),
                DB::raw("'Blog' as type_name"),
                'status',
                'created_at',
                'updated_at',
                DB::raw("'blog' as source_table")
            );

        $this->resources = $documentResources->unionAll($blogResources)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}