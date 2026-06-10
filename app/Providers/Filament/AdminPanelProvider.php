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
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;
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
        FilamentView::registerRenderHook(
            PanelsRenderHook::STYLES_AFTER,
            fn (): string => Blade::render('
                <style>
                    /* ── Item activo: background azul sólido ── */
                    .fi-sidebar-item.fi-active .fi-sidebar-item-btn {
                        background-color: rgb(37 99 235) !important;
                        border-radius: .5rem;
                    }
                    .fi-sidebar-item.fi-active .fi-sidebar-item-btn .fi-sidebar-item-icon,
                    .fi-sidebar-item.fi-active .fi-sidebar-item-btn .fi-sidebar-item-label {
                        color: #fff !important;
                    }
                    /* ── Hover items inactivos ── */
                    .fi-sidebar-item:not(.fi-active) .fi-sidebar-item-btn:hover {
                        background-color: rgba(37,99,235,.15) !important;
                        border-radius: .5rem;
                    }
                </style>
            '),
        );
    }

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
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
            ->brandLogo(view('filament.components.brand-logo'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('images/home/company-icon.png'))
            ->globalSearch(true)
            ->globalSearchKeyBindings(['ctrl+k', 'cmd+k'])
            ->sidebarCollapsibleOnDesktop()
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
                EnsureUserIsAdmin::class,
            ]);
    }
}
