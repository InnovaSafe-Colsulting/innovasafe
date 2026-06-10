<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class UserForm
{
    public static function getSchema(): array
    {
        return [
            TextInput::make('names')
                ->label('Nombres')
                ->required()
                ->maxLength(255),
            TextInput::make('last_names')
                ->label('Apellidos')
                ->required()
                ->maxLength(255),
            TextInput::make('email')
                ->label('Correo Electrónico')
                ->email()
                ->required()
                ->maxLength(255),
            TextInput::make('cellphone')
                ->label('Celular')
                ->tel()
                ->maxLength(20),
            Select::make('city_id')
                ->label('Ciudad')
                ->relationship('city', 'name')
                ->required()
                ->searchable()
                ->preload(),
            TextInput::make('address')
                ->label('Dirección')
                ->maxLength(255),
            TextInput::make('neighboarhood')
                ->label('Barrio')
                ->maxLength(255),
            Select::make('role_id')
                ->label('Rol')
                ->relationship('role', 'role')
                ->required()
                ->searchable()
                ->preload(),
            Toggle::make('status')
                ->label('Estado')
                ->required(),
            TextInput::make('password')
                ->label('Contraseña')
                ->password()
                ->dehydrateStateUsing(fn ($state) => filled($state) ? $state : null)
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (string $context): bool => $context === 'create')
                ->maxLength(255)
                ->label('Contraseña')
                ->helperText('Dejar vacío para mantener la contraseña actual'),
        ];
    }
}
