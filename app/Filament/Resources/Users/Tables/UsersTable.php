<?php

namespace App\Filament\Resources\Users\Tables;

use App\Models\Role;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('names')
                    ->label('Nombre')
                    ->formatStateUsing(fn ($record) => $record->names . ' ' . $record->last_names)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Correo')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('cellphone')
                    ->label('Celular')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('role.role')
                    ->label('Rol')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('city.name')
                    ->label('Ciudad')
                    ->searchable()
                    ->sortable(),
                ToggleColumn::make('status')
                    ->label('Estado'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Editar'),
                DeleteAction::make()
                    ->label('Borrar'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Borrar'),
                ]),
            ]);
    }
}
