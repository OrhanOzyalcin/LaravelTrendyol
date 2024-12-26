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
            $config = $app['config']['trendyol'] ?? [];

            return new TrendyolClient([
                'base_uri' => $config['base_url'] ?? '',
                'auth' => [
                    $config['username'] ?? '',
                    $config['password'] ?? '',
                ],
            ]);
        });

        $this->app->singleton(OrderService::class, function ($app) {
            return new OrderService($app->make(TrendyolClient::class));
        });
    }

    public function boot()
    {
        // Dinamik yapılandırmayı buraya taşıyabilirsiniz
        $this->publishes([
            __DIR__ . '/../config/trendyol.php' => config_path('trendyol.php'),
        ]);
    }
}
