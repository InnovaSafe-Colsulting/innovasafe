<?php

namespace App\Filament\Resources\ClientResource\Schemas;

use App\Models\User;
use App\Models\City;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;

class ClientForm
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
                ->label('Email')
                ->email()
                ->required()
                ->unique(User::class, 'email', ignoreRecord: true)
                ->maxLength(255),
            TextInput::make('cellphone')
                ->label('Teléfono')
                ->tel()
                ->maxLength(255),
            Select::make('city_id')
                ->label('Ciudad')
                ->relationship('city', 'name')
                ->required()
                ->searchable()
                ->preload(),
            TextInput::make('password')
                ->label('Contraseña')
                ->password()
                ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (string $context): bool => $context === 'create')
                ->minLength(8)
                ->maxLength(255)
                ->helperText('Dejar vacío para mantener la contraseña actual'),
            Hidden::make('role_id')
                ->default(3),
        ];
    }
}