<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use UnitEnum;

class BannersPage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected string $view = 'filament.pages.banners';

    protected static ?string $navigationLabel = 'Banners';

    protected static ?string $title = 'Banners';

    protected static string|UnitEnum|null $navigationGroup = 'Configuración';

    protected static ?int $navigationSort = 1;

    public $banners = [];
    public bool $showDeleteModal = false;
    public int $deleteId = 0;

    public function mount(): void
    {
        $this->loadBanners();
    }

    public function loadBanners(): void
    {
        $this->banners = DB::table('banners')->orderBy('position')->orderBy('created_at')->get();
    }

    public function toggleStatus(int $id): void
    {
        $banner = DB::table('banners')->where('id', $id)->first();
        DB::table('banners')->where('id', $id)->update([
            'status'     => $banner->status ? 0 : 1,
            'updated_at' => now(),
        ]);
        $this->loadBanners();
    }

    public function confirmDelete(int $id): void
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal(): void
    {
        $this->showDeleteModal = false;
        $this->deleteId = 0;
    }

    public function delete(): void
    {
        $banner = DB::table('banners')->where('id', $this->deleteId)->first();
        if ($banner && $banner->image) {
            @unlink(public_path($banner->image));
        }
        DB::table('banners')->where('id', $this->deleteId)->delete();
        $this->closeDeleteModal();
        $this->loadBanners();
    }
}
