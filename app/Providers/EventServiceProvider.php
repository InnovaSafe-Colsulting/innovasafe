<?php

namespace App\Providers;

use App\Events\UserCreated;
use App\Listeners\SendUserCreatedNotification;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app['events']->listen(
            UserCreated::class,
            SendUserCreatedNotification::class,
        );
    }
}
