<?php

namespace DDD\App\Providers;

use DDD\App\Services\Crawler\CrawlerApify;
use DDD\App\Services\Crawler\CrawlerInterface;
use Illuminate\Support\ServiceProvider;

class CrawlerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CrawlerInterface::class, function ($app) {
            return new CrawlerApify(
                token: config('services.apify.token'),
                cheerioActor: config('services.apify.cheerioActor'),
                puppeteerActor: config('services.apify.puppeteerActor'),
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
