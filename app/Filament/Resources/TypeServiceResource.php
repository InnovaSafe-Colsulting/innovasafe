<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypeServiceResource\Pages;
use App\Filament\Resources\TypeServiceResource\Schemas\TypeServiceForm;
use App\Models\TypeService;
use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use UnitEnum;

class TypeServiceResource extends Resource
{
    protected static ?string $model = TypeService::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Servicios';

    protected static ?string $pluralModelLabel = 'Servicios';

    protected static ?string $modelLabel = 'Servicio';

    protected static string|UnitEnum|null $navigationGroup = 'Gestión';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema->components(TypeServiceForm::getSchema());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Descripción')
                    ->limit(50)
                    ->searchable(),
                ToggleColumn::make('status')
                    ->label('Estado')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->searchPlaceholder('Buscar servicios...')
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('details')
                    ->label('Detalles')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->modalHeading(fn ($record) => "Detalles de {$record->name}")
                    ->modalContent(fn ($record) => view('filament.pages.service-details-modal', ['service' => \App\Models\TypeService::find($record->id)]))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Cerrar'),
                EditAction::make()->label('Editar'),
                DeleteAction::make()->label('Borrar'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Borrar'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTypeServices::route('/'),
            'create' => Pages\CreateTypeService::route('/create'),
            'edit' => Pages\EditTypeService::route('/{record}/edit'),
        ];
    }
}