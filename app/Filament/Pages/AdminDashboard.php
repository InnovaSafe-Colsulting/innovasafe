<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class AdminDashboard extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-home';

    protected string $view = 'filament.pages.admin-dashboard-clean';

    protected static ?string $navigationLabel = 'InnovaSafe';

    protected static ?string $title = '';

    protected static bool $shouldRegisterNavigation = true;

    protected static ?int $navigationSort = -10;

    public function getHeading(): string
    {
        return '';
    }

    public function getViewData(): array
    {
        $user = auth()->user();
        
        // Verificar que el usuario existe antes de procesar
        if (!$user) {
            return [
                'user' => null,
                'greeting' => 'Buen día',
                'now' => now(),
            ];
        }

        $hour = now()->hour;
        $greeting = match (true) {
            $hour >= 5 && $hour < 12  => 'Buenos días',
            $hour >= 12 && $hour < 18 => 'Buenas tardes',
            default                   => 'Buenas noches',
        };

        return [
            'user'     => $user,
            'greeting' => $greeting,
            'now'      => now(),
        ];
    }
}
