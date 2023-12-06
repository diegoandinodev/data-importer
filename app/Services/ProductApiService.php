<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

class ProductApiService
{
    private $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function fetch($url)
    {
        try {
            $response = $this->httpClient->get($url);

            $res = json_decode($response->getBody(), true);
            $code = $response->getStatusCode();
        } catch (BadResponseException $ex) {
            $res = $ex->getResponse()->getBody();
            $code = 500;
        }

        return $res;
    }
}
