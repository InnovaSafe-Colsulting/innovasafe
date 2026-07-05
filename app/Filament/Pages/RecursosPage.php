<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use UnitEnum;

class RecursosPage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFolderOpen;

    protected string $view = 'filament.pages.recursos.index';

    protected static ?string $navigationLabel = 'Recursos';

    protected static ?string $title = 'Gestión de Recursos';

    protected static string|UnitEnum|null $navigationGroup = 'Gestión';

    protected static ?int $navigationSort = 4;

    public $activeFilter = 'blog';
    public $resourceTypes = [];
    public $blogs = [];
    public $documents = [];

    public function mount(): void
    {
        $this->resourceTypes = DB::table('resources_types')->get()->toArray();

        $this->blogs = DB::table('blog_resource_details')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($r) {
                $r->created_at = $r->created_at ? Carbon::parse($r->created_at)->format('d/m/Y H:i') : '-';
                return $r;
            })->toArray();

        $this->documents = DB::table('documents_resources_details')
            ->join('resources_types', 'documents_resources_details.resource_type_id', '=', 'resources_types.id')
            ->select('documents_resources_details.*', 'resources_types.resource as type_name')
            ->orderBy('documents_resources_details.created_at', 'desc')
            ->get()
            ->map(function ($r) {
                $r->created_at = $r->created_at ? Carbon::parse($r->created_at)->format('d/m/Y H:i') : '-';
                return $r;
            })->toArray();
    }

    public function toggleStatus(int $id, string $type, int $status): void
    {
        $table = $type === 'blog' ? 'blog_resource_details' : 'documents_resources_details';
        DB::table($table)->where('id', $id)->update(['status' => $status, 'updated_at' => now()]);
        $this->mount();
    }

    public function deleteResource(int $id, string $type): void
    {
        if ($type === 'blog') {
            $resource = DB::table('blog_resource_details')->where('id', $id)->first();
            if ($resource && $resource->image) Storage::disk('public')->delete($resource->image);
            DB::table('blog_resource_details')->where('id', $id)->delete();
        } else {
            $resource = DB::table('documents_resources_details')->where('id', $id)->first();
            if ($resource && $resource->path) Storage::disk('public')->delete($resource->path);
            DB::table('documents_resources_details')->where('id', $id)->delete();
        }
        $this->mount();
        $this->dispatch('resource-deleted');
    }
}
