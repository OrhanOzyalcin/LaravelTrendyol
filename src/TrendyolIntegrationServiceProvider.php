<?php

namespace OrhanOzyalcin\TrendyolIntegration;

use Illuminate\Support\ServiceProvider;

class TrendyolIntegrationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(TrendyolClient::class, function ($app) {
            return new TrendyolClient(config('trendyol'));
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/trendyol.php' => config_path('trendyol.php'),
        ], 'config');
    }
}
