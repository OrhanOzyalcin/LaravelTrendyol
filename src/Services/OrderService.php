<?php

namespace OrhanOzyalcin\TrendyolIntegration\Services;

use OrhanOzyalcin\TrendyolIntegration\TrendyolClient;

class OrderService
{
    protected $client;

    public function __construct(TrendyolClient $client)
    {
        $this->client = $client;
    }

    /**
     * Siparişleri Listeleme
     */
    public function getOrders(string $supplierId, string $orderByField = 'PackageLastModifiedDate', string $orderByDirection = 'DESC', int $size = 50)
    {
        return $this->client->request('GET', "/suppliers/{$supplierId}/orders", [
            'orderByField' => $orderByField,
            'orderByDirection' => $orderByDirection,
            'size' => $size,
        ]);
    }

    /**
     * Kargo Takip Kodu Güncelleme
     */
    public function updateTrackingNumber(string $supplierId, string $shipmentPackageId, string $trackingNumber)
    {
        return $this->client->request('PUT', "/suppliers/{$supplierId}/{$shipmentPackageId}/update-tracking-number", [
            'trackingNumber' => $trackingNumber,
        ]);
    }

    /**
     * Paket Statü Güncelleme (Picking, Invoiced vb.)
     */
    public function updatePackageStatus(string $supplierId, string $shipmentPackageId, array $lines, string $status, array $params = [])
    {
        $data = [
            'lines' => $lines,
            'status' => $status,
            'params' => $params,
        ];

        return $this->client->request('PUT', "/suppliers/{$supplierId}/shipment-packages/{$shipmentPackageId}", $data);
    }

    /**
     * Sipariş Paketlerini Bölme
     */
    public function splitOrderPackage(string $supplierId, string $shipmentPackageId, array $splitPackages)
    {
        return $this->client->request('POST', "/suppliers/{$supplierId}/shipment-packages/{$shipmentPackageId}/split-packages", [
            'splitPackages' => $splitPackages,
        ]);
    }

    /**
     * Kargo Sağlayıcıyı Değiştirme
     */
    public function changeCargoProvider(string $supplierId, string $shipmentPackageId, string $cargoProvider)
    {
        return $this->client->request('POST', "/suppliers/{$supplierId}/shipment-packages/{$shipmentPackageId}/cargo-providers", [
            'cargoProvider' => $cargoProvider,
        ]);
    }
}
