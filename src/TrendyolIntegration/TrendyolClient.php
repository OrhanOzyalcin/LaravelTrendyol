<?php

namespace orhanozyalcin\TrendyolIntegration;

use GuzzleHttp\Client;

class TrendyolClient
{
    protected $client;

    public function __construct(array $config)
    {
        $this->client = new Client([
            'base_uri' => $config['base_url'],
            'auth' => [$config['username'], $config['password']],
        ]);
    }

    public function request($method, $endpoint, $data = [])
    {
        $options = [];

        if ($method === 'GET') {
            $options['query'] = $data;
        } else {
            $options['json'] = $data;
        }

        return $this->client->request($method, $endpoint, $options);
    }
}
