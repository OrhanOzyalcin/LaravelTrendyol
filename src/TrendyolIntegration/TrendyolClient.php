<?php

namespace OrhanOzyalcin\TrendyolIntegration;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class TrendyolClient
{
    protected Client $client;
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->client = new Client([
            'base_uri' => $this->config['base_url'] ?? '',
            'auth' => [
                $this->config['username'] ?? '',
                $this->config['password'] ?? ''
            ],
            'timeout' => $this->config['timeout'] ?? 10, // Varsayılan bir timeout eklenebilir
        ]);
    }

    /**
     * Make a request to the Trendyol API.
     *
     * @param string $method HTTP method (GET, POST, PUT, DELETE, etc.)
     * @param string $endpoint API endpoint
     * @param array $data Data to send in the request
     * @return array Decoded JSON response
     * @throws \Exception If the request fails
     */
    public function request(string $method, string $endpoint, array $data = []): array
    {
        $options = $this->prepareOptions($method, $data);

        try {
            $response = $this->client->request($method, $endpoint, $options);
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            throw new \Exception($this->handleException($e));
        }
    }

    /**
     * Prepare options for the HTTP request.
     *
     * @param string $method HTTP method
     * @param array $data Request data
     * @return array Prepared options
     */
    protected function prepareOptions(string $method, array $data): array
    {
        $options = [];

        if (strtoupper($method) === 'GET') {
            $options['query'] = $data;
        } else {
            $options['json'] = $data;
        }

        return $options;
    }

    /**
     * Handle Guzzle exceptions and return meaningful messages.
     *
     * @param RequestException $e
     * @return string
     */
    protected function handleException(RequestException $e): string
    {
        if ($e->hasResponse()) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();
            return "HTTP {$statusCode}: " . $body;
        }

        return $e->getMessage();
    }
}
