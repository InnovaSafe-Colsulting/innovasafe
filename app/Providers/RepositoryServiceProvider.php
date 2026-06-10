<?php

namespace App\Providers;

use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\AuthServiceInterface;
use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\CityServiceInterface;
use App\Interfaces\ConfigurationCompanyRepositoryInterface;
use App\Interfaces\ConfigurationCompanyServiceInterface;
use App\Interfaces\ContactRepositoryInterface;
use App\Interfaces\ContactServiceInterface;
use App\Interfaces\CountryRepositoryInterface;
use App\Interfaces\CountryServiceInterface;
use App\Interfaces\NavigationMenuRepositoryInterface;
use App\Interfaces\NavigationMenuServiceInterface;
use App\Interfaces\RoleRepositoryInterface;
use App\Interfaces\RoleServiceInterface;
use App\Interfaces\TypePaymentRepositoryInterface;
use App\Interfaces\TypePaymentServiceInterface;
use App\Interfaces\TypePaymentDetailRepositoryInterface;
use App\Interfaces\TypePaymentDetailServiceInterface;
use App\Interfaces\TypeServiceRepositoryInterface;
use App\Interfaces\TypeServiceServiceInterface;
use App\Repositories\AuthRepository;
use App\Repositories\CityRepository;
use App\Repositories\ConfigurationCompanyRepository;
use App\Repositories\ContactRepository;
use App\Repositories\CountryRepository;
use App\Repositories\NavigationMenuRepository;
use App\Repositories\RoleRepository;
use App\Repositories\TypePaymentRepository;
use App\Repositories\TypePaymentDetailRepository;
use App\Repositories\TypeServiceRepository;
use App\Services\AuthService;
use App\Services\CityService;
use App\Services\ConfigurationCompanyService;
use App\Services\ContactService;
use App\Services\CountryService;
use App\Services\NavigationMenuService;
use App\Services\RoleService;
use App\Services\TypePaymentService;
use App\Services\TypePaymentDetailService;
use App\Services\TypeServiceService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(CountryServiceInterface::class, CountryService::class);
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->bind(CityServiceInterface::class, CityService::class);
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(RoleServiceInterface::class, RoleService::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(TypeServiceServiceInterface::class, TypeServiceService::class);
        $this->app->bind(TypeServiceRepositoryInterface::class, TypeServiceRepository::class);
        $this->app->bind(ContactServiceInterface::class, ContactService::class);
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
        $this->app->bind(ConfigurationCompanyServiceInterface::class, ConfigurationCompanyService::class);
        $this->app->bind(ConfigurationCompanyRepositoryInterface::class, ConfigurationCompanyRepository::class);
        $this->app->bind(NavigationMenuServiceInterface::class, NavigationMenuService::class);
        $this->app->bind(NavigationMenuRepositoryInterface::class, NavigationMenuRepository::class);
        $this->app->bind(TypePaymentServiceInterface::class, TypePaymentService::class);
        $this->app->bind(TypePaymentRepositoryInterface::class, TypePaymentRepository::class);
        $this->app->bind(TypePaymentDetailServiceInterface::class, TypePaymentDetailService::class);
        $this->app->bind(TypePaymentDetailRepositoryInterface::class, TypePaymentDetailRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
