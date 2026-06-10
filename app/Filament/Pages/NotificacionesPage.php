<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class NotificacionesPage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBell;

    protected string $view = 'filament.pages.coming-soon';

    protected static ?string $navigationLabel = 'Notificaciones';

    protected static ?string $title = 'Notificaciones';

    protected static string|UnitEnum|null $navigationGroup = 'Gestión';

    protected static ?int $navigationSort = 7;

    public static function getNavigationBadge(): ?string
    {
        return '5'; // 🔴 QUEMADO
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'danger';
    }
}
