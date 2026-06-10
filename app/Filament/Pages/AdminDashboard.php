<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class AdminDashboard extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-home';

    protected string $view = 'filament.pages.admin-dashboard';

    protected static ?string $navigationLabel = 'Dashboard';

    protected static ?string $title = '';

    protected static bool $shouldRegisterNavigation = true;

    protected static ?int $navigationSort = -10;

    public function getHeading(): string
    {
        return '';
    }

    public function getViewData(): array
    {
        $user = Auth::user();

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
