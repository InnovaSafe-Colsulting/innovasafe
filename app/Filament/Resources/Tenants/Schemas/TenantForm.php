<?php

namespace App\Filament\Resources\Tenants\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class TenantForm
{
    public static function getSchema(): array
    {
        return [
            TextInput::make('name')
                ->label('Nombre')
                ->required()
                ->maxLength(255),
            TextInput::make('commercial_name')
                ->label('Nombre Comercial')
                ->maxLength(255),
            TextInput::make('legal_name')
                ->label('Razón Social')
                ->maxLength(255),
            TextInput::make('email')
                ->label('Correo Electrónico')
                ->email()
                ->maxLength(255),
            TextInput::make('phone')
                ->label('Teléfono')
                ->tel()
                ->maxLength(20),
            TextInput::make('address')
                ->label('Dirección')
                ->maxLength(255),
            TextInput::make('neighborhood')
                ->label('Barrio')
                ->maxLength(255),
            Select::make('city_id')
                ->label('Ciudad')
                ->relationship('city', 'name')
                ->searchable()
                ->preload(),
            TextInput::make('timezone')
                ->label('Zona Horaria')
                ->maxLength(100),
            FileUpload::make('logo')
                ->label('Logo')
                ->image()
                ->directory('tenants/logos'),
            Toggle::make('status')
                ->label('Activo'),
        ];
    }
}
