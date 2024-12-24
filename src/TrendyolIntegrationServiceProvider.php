<?php

namespace OrhanOzyalcin\TrendyolIntegration;

use Illuminate\Support\ServiceProvider;
use OrhanOzyalcin\TrendyolIntegration\Services\OrderService;
use OrhanOzyalcin\TrendyolIntegration\TrendyolClient;

class TrendyolIntegrationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(TrendyolClient::class, function ($app) {
            return new TrendyolClient([
                'base_uri' => config('trendyol.base_url'),
                'auth' => [
                    config('trendyol.username'),
                    config('trendyol.password'),
                ],
            ]);
        });

        $this->app->singleton(OrderService::class, function ($app) {
            return new OrderService($app->make(TrendyolClient::class));
        });
    }

    public function boot()
    {
        // Paketinizin bootstrap işlemleri
    }
}
