<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    private function imagesPath(): string
    {
        $env = env('PUBLIC_IMAGES_PATH');
        return $env ?: public_path('images/banners');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'position' => 'required|integer|min:0',
            'movil'    => 'required|in:0,1',
            'image'    => 'required|image|mimes:jpeg,png,webp|max:5120',
            'status'   => 'required|in:0,1',
        ], [
            'name.required'  => 'El nombre es obligatorio.',
            'image.required' => 'La imagen es obligatoria.',
            'image.image'    => 'El archivo debe ser una imagen.',
            'image.mimes'    => 'Solo se permiten imágenes JPEG, PNG o WEBP.',
            'image.max'      => 'La imagen no debe superar 5MB.',
        ]);

        $destPath = $this->imagesPath();
        if (!file_exists($destPath)) mkdir($destPath, 0755, true);

        $filename = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move($destPath, $filename);

        DB::table('banners')->insert([
            'name'       => $request->name,
            'position'   => $request->position,
            'movil'      => $request->movil,
            'image'      => 'images/banners/' . $filename,
            'status'     => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('filament.admin.pages.banners-page');
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'position' => 'required|integer|min:0',
            'movil'    => 'required|in:0,1',
            'image'    => 'nullable|image|mimes:jpeg,png,webp|max:5120',
            'status'   => 'required|in:0,1',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'image.image'   => 'El archivo debe ser una imagen.',
            'image.mimes'   => 'Solo se permiten imágenes JPEG, PNG o WEBP.',
            'image.max'     => 'La imagen no debe superar 5MB.',
        ]);

        $data = [
            'name'       => $request->name,
            'position'   => $request->position,
            'movil'      => $request->movil,
            'status'     => $request->status,
            'updated_at' => now(),
        ];

        if ($request->hasFile('image')) {
            $destPath = $this->imagesPath();
            if (!file_exists($destPath)) mkdir($destPath, 0755, true);

            $banner = DB::table('banners')->where('id', $id)->first();
            if ($banner && $banner->image) {
                @unlink(rtrim($destPath, '/') . '/' . basename($banner->image));
            }

            $filename      = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($destPath, $filename);
            $data['image'] = 'images/banners/' . $filename;
        }

        DB::table('banners')->where('id', $id)->update($data);

        return redirect()->route('filament.admin.pages.banners-page');
    }
}
