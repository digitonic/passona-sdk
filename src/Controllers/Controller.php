<?php


namespace Digitonic\PassonaClient\Controllers;


use GuzzleHttp\Client;

abstract class Controller
{
    /**
     * @var array
     */
    protected $headers;
    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client, $organizationId, $apiToken)
    {
        $this->client = $client;
        $this->headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $apiToken,
            'Organization' => $organizationId
        ];
    }
}