<?php

namespace App\Filament\Resources\TypeServiceResource\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class TypeServiceForm
{
    public static function getSchema(): array
    {
        return [
            TextInput::make('name')
                ->label('Nombre del Servicio')
                ->required()
                ->maxLength(100)
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
            TextInput::make('slug')
                ->label('Slug')
                ->required()
                ->maxLength(100),
            Textarea::make('description')
                ->label('Descripción')
                ->rows(3),
            TextInput::make('video_url')
                ->label('URL del Video')
                ->maxLength(255),
            Toggle::make('is_active')
                ->label('Activo')
                ->default(true),
        ];
    }
}
