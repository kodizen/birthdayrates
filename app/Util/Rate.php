<?php

namespace App\Util;

use GuzzleHttp\Client;

class Rate
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function latest()
    {
        return $this->endpointRequest('/latest');
    }

    public function findByDate($date)
    {
        
        return $this->endpointRequest('/' . $date);
    }

    public function endpointRequest($url)
    {
        try {
            $response = $this->client->request('GET', $url . '?access_key=' . config('services.fixer.key'));
        } catch (\Exception $e) {
            return [];
        }

        return $this->response_handler($response->getBody()->getContents());
    }

    public function response_handler($response)
    {
        if ($response) {
            return json_decode($response);
        }

        return [];
    }
}
