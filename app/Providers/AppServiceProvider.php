<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        if (app()->isProduction() && ! empty(($app_url = config('app.url')))) {
            URL::forceRootUrl($app_url);
            URL::forceScheme(explode(':', $app_url)[0]);
        }
    }
}
