<?php


namespace Digitonic\PassonaClient\Controllers;

use GuzzleHttp\Client;

abstract class Controller
{
    /**
     * @var array
     */
    protected $headers = [];
    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client, $organizationId, $apiToken)
    {
        $this->client = $client;
        $this->headers['Content-Type'] = 'application/json';
        $this->resetOrganizationIdHeader($organizationId);
        $this->resetApiTokenHeader($apiToken);
    }

    public function resetOrganizationIdHeader(int $orgId)
    {
        $this->headers['Organization'] = $orgId;
    }

    public function resetApiTokenHeader(string $apiToken)
    {
        $this->headers['Authorization'] = 'Bearer ' . $apiToken;
    }
}
