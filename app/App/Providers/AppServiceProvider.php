<?php

namespace DDD\App\Providers;

use DDD\App\Services\CDN\CDNInterface;
// Interfaces
use DDD\App\Services\CDN\DigitalOceanCDNService;
// Services
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->bind(CDNInterface::class, DigitalOceanCDNService::class);
    }
}
