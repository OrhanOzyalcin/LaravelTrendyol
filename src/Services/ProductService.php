<?php

namespace OrhanOzyalcin\TrendyolIntegration\Services;

use OrhanOzyalcin\TrendyolIntegration\TrendyolClient;

class ProductService
{
    protected $client;

    public function __construct(TrendyolClient $client)
    {
        $this->client = $client;
    }

    public function transferProduct(array $productData)
    {
        return $this->client->request('POST', '/suppliers/{supplierId}/v2/products', $productData);
    }

    public function getProducts($supplierId, $page = 0, $size = 50)
    {
        return $this->client->request('GET', "/suppliers/{$supplierId}/products", [
            'page' => $page,
            'size' => $size,
        ]);
    }

    // Diğer metotları ekleyebilirsiniz.
}
