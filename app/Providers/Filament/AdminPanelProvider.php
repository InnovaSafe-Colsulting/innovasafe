<?php

namespace App\Providers\Filament;

use App\Filament\Pages\AdminDashboard;
use App\Http\Middleware\EnsureUserIsAdmin;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function boot(): void
    {
        //
    }

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->authGuard('web')
            ->authPasswordBroker('users')
            ->profile()
            ->userMenuItems([
                'profile' => \Filament\Navigation\MenuItem::make()
                    ->label('Perfil')
                    ->url(fn (): string => '#')
                    ->icon('heroicon-o-user-circle'),
                'logout' => \Filament\Navigation\MenuItem::make()
                    ->label('Cerrar sesión')
                    ->url('/logout')
                    ->icon('heroicon-o-arrow-right-on-rectangle'),
            ])
            ->darkMode(true)
            ->defaultThemeMode(ThemeMode::Dark)
            ->colors([
                'primary' => Color::Blue,
                'gray' => [
                    50  => '#f8fafc',
                    100 => '#f1f5f9',
                    200 => '#e2e8f0',
                    300 => '#cbd5e1',
                    400 => '#94a3b8',
                    500 => '#64748b',
                    600 => '#475569',
                    700 => '#334155',
                    800 => '#1e293b',
                    900 => '#0f172a',
                    950 => '#080e1a',
                ],
            ])
            ->brandName('InnovaSafe')
            ->brandLogo(fn (): string => view('filament.components.brand-logo')->render())
            ->brandLogoHeight('3rem')
            ->favicon(asset('images/home/company-icon.png'))
            ->globalSearch(true)
            ->globalSearchKeyBindings(['ctrl+k', 'cmd+k'])
            ->sidebarCollapsibleOnDesktop()
            ->userMenuItems([
                'logout' => \Filament\Navigation\MenuItem::make()
                    ->label('Cerrar sesión')
                    ->url('/logout')
                    ->icon('heroicon-o-arrow-right-on-rectangle'),
            ])

            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                AdminDashboard::class,
            ])
            ->navigationGroups([
                NavigationGroup::make('Gestión')
                    ->collapsible(false),
                NavigationGroup::make('Otros')
                    ->collapsible(false),
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                \App\Http\Middleware\AdminOnly::class,
            ]);
    }
}
