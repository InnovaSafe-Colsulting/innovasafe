<?php

namespace App\Providers;

use App\Interfaces\ConfigurationCompanyServiceInterface;
use App\Interfaces\NavigationMenuServiceInterface;
use App\Interfaces\TypeServiceServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (request()->is('admin*')) {
        Log::info('Admin request', [
            'check' => Auth::check(),
            'user' => Auth::user()?->email,
            'role' => Auth::user()?->role_id,
        ]);
    }
        View::composer('layouts.app', function ($view) {
            $configService = app(ConfigurationCompanyServiceInterface::class);
            $configs = $configService->getAll();

            $companyConfig = [];
            foreach ($configs as $config) {
                $companyConfig[$config->name] = $config->value;
            }

            $typeServiceService = app(TypeServiceServiceInterface::class);
            $footerServices = $typeServiceService->getAll();

            $menuService = app(NavigationMenuServiceInterface::class);
            $footerNavigation = $menuService->getActive();

            $view->with('companyConfig', $companyConfig)
                 ->with('footerServices', $footerServices)
                 ->with('footerNavigation', $footerNavigation);
        });
    }
}
