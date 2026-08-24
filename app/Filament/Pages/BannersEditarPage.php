<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use UnitEnum;

class BannersEditarPage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected string $view = 'filament.pages.banners.edit';

    protected static ?string $navigationLabel = 'Editar Banner';

    protected static ?string $title = 'Editar Banner';

    protected static bool $shouldRegisterNavigation = false;

    public int $bannerId;
    public string $name = '';
    public int $position = 0;
    public $image = null;
    public string $currentImage = '';
    public int $status = 1;

    public function mount(int $id): void
    {
        $banner = DB::table('banners')->where('id', $id)->firstOrFail();
        $this->bannerId     = $banner->id;
        $this->name         = $banner->name;
        $this->position     = $banner->position;
        $this->currentImage = $banner->image;
        $this->status       = $banner->status;
    }

    public function save()
    {
        $this->validate([
            'name'     => 'required|string|max:255',
            'position' => 'required|integer|min:0',
            'image'    => 'nullable|image|mimes:jpeg,png,webp|max:2048',
            'status'   => 'required|boolean',
        ], [
            'name.required'     => 'El nombre es obligatorio.',
            'position.required' => 'La posición es obligatoria.',
            'position.integer'  => 'La posición debe ser un número.',
            'image.image'       => 'El archivo debe ser una imagen.',
            'image.mimes'       => 'Solo se permiten imágenes JPEG, PNG o WEBP.',
            'image.max'         => 'La imagen no debe superar 2MB.',
        ]);

        $data = [
            'name'       => $this->name,
            'position'   => $this->position,
            'status'     => $this->status,
            'updated_at' => now(),
        ];

        if ($this->image) {
            if ($this->currentImage) @unlink(public_path($this->currentImage));
            $filename = uniqid() . '.' . $this->image->getClientOriginalExtension();
            $this->image->move(public_path('images/banners'), $filename);
            $data['image'] = 'images/banners/' . $filename;
        }

        DB::table('banners')->where('id', $this->bannerId)->update($data);

        return redirect()->route('filament.admin.pages.banners-page');
    }
}
