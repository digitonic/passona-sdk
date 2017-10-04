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

    public function __construct(Client $client, $organizationId, $username, $apiKey)
    {
        $this->client = $client;
        $this->headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . $this->getBase64EncodedUsernameAndApiKey($username, $apiKey),
            'Organization' => $organizationId
        ];
    }

    /**
     * @param $username
     * @param $apiKey
     * @return string
     */
    private function getBase64EncodedUsernameAndApiKey($username, $apiKey): string
    {
        return base64_encode("{$username}:{$apiKey}");
    }
}