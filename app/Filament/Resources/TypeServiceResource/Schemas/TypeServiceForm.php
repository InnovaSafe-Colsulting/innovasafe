<?php

namespace App\Filament\Resources\TypeServiceResource\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;

class TypeServiceForm
{
    public static function getSchema(): array
    {
        return [
            TextInput::make('name')
                ->label('Nombre del Servicio')
                ->required()
                ->maxLength(100),
            Textarea::make('description')
                ->label('Descripción')
                ->rows(3),
            TextInput::make('video_url')
                ->label('URL del Video')
                ->maxLength(255),
            Toggle::make('status')
                ->label('Activo')
                ->default(true),
            
            Placeholder::make('modules_section')
                ->content(fn () => view('filament.forms.modules-section')),
            
            Hidden::make('modules')
                ->default([]),
        ];
    }
}