<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use UnitEnum;

class BannersCrearPage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected string $view = 'filament.pages.banners.create';

    protected static ?string $navigationLabel = 'Crear Banner';

    protected static ?string $title = 'Crear Banner';

    protected static bool $shouldRegisterNavigation = false;

    public string $name = '';
    public int $position = 0;
    public $image = null;
    public int $status = 1;

    public function save()
    {
        $this->validate([
            'name'     => 'required|string|max:255',
            'position' => 'required|integer|min:0',
            'image'    => 'required|image|mimes:jpeg,png,webp|max:2048',
            'status'   => 'required|boolean',
        ], [
            'name.required'     => 'El nombre es obligatorio.',
            'position.required' => 'La posición es obligatoria.',
            'position.integer'  => 'La posición debe ser un número.',
            'image.required'    => 'La imagen es obligatoria.',
            'image.image'       => 'El archivo debe ser una imagen.',
            'image.mimes'       => 'Solo se permiten imágenes JPEG, PNG o WEBP.',
            'image.max'         => 'La imagen no debe superar 2MB.',
        ]);

        $filename = uniqid() . '.' . $this->image->getClientOriginalExtension();
        $this->image->move(public_path('images/banners'), $filename);

        DB::table('banners')->insert([
            'name'       => $this->name,
            'position'   => $this->position,
            'image'      => 'images/banners/' . $filename,
            'status'     => $this->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('filament.admin.pages.banners-page');
    }
}
