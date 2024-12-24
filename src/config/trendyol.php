<?php

return [
    'environment' => env('TRENDYOL_ENV', 'staging'),
    'base_url' => env('TRENDYOL_ENV', 'staging') === 'production'
        ? env('TRENDYOL_BASE_URL_PRODUCTION', 'https://api.trendyol.com/sapigw')
        : env('TRENDYOL_BASE_URL_STAGING', 'https://stageapi.trendyol.com/stagesapigw'),
    'username' => env('TRENDYOL_USERNAME', ''),
    'password' => env('TRENDYOL_PASSWORD', ''),
];
