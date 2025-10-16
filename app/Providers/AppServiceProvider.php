<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS only for production Render deployment, not for local development
        if (config('app.env') === 'production' &&
            config('app.url') &&
            str_starts_with(config('app.url'), 'https://') &&
            !str_contains(config('app.url'), 'localhost') &&
            !str_contains(config('app.url'), '127.0.0.1') &&
            !str_contains(config('app.url'), 'carbonwallet.test')) {
            URL::forceScheme('https');
        }

        // Force HTTP for local development
        if (config('app.env') === 'local' ||
            str_contains(config('app.url'), 'localhost') ||
            str_contains(config('app.url'), '127.0.0.1') ||
            str_contains(config('app.url'), 'carbonwallet.test')) {
            URL::forceScheme('http');
        }
    }
}
