<?php

namespace orhanozyalcin\TrendyolIntegration\Services;

use orhanozyalcin\TrendyolIntegration\TrendyolClient;

class CargoService
{
    protected $client;

    public function __construct(TrendyolClient $client)
    {
        $this->client = $client;
    }

    /**
     * Kargo Sağlayıcılarını Listeleme
     */
    public function getShipmentProviders()
    {
        return $this->client->request('GET', '/shipment-providers');
    }

    /**
     * İade ve Sevkiyat Adreslerini Listeleme
     */
    public function getWarehouseAddresses(string $supplierId)
    {
        return $this->client->request('GET', "/suppliers/{$supplierId}/addresses");
    }

    /**
     * Kargo Takip Kodu Güncelleme
     *
     * @param string $supplierId
     * @param string $shipmentPackageId
     * @param string $trackingNumber
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateTrackingNumber(string $supplierId, string $shipmentPackageId, string $trackingNumber)
    {
        return $this->client->request('PUT', "/suppliers/{$supplierId}/{$shipmentPackageId}/update-tracking-number", [
            'trackingNumber' => $trackingNumber,
        ]);
    }

    /**
     * Kargo Sağlayıcısını Güncelleme
     *
     * @param string $supplierId
     * @param string $shipmentPackageId
     * @param string $cargoProvider
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function changeCargoProvider(string $supplierId, string $shipmentPackageId, string $cargoProvider)
    {
        return $this->client->request('POST', "/suppliers/{$supplierId}/shipment-packages/{$shipmentPackageId}/cargo-providers", [
            'cargoProvider' => $cargoProvider,
        ]);
    }
}
