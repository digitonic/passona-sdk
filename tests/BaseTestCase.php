<?php

namespace Digitonic\PassonaClient\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Orchestra\Testbench\TestCase;

class BaseTestCase extends TestCase
{
    /**
     * @var \Digitonic\PassonaClient\Client
     */
    protected $client;

    /**
     * @var Response|null
     */
    protected $response = null;

    /**
     *
     * @return void
     */
    protected function setConfig(): void
    {
        $this->app['config']->set('passona-sdk.passona_api_key', 'KxDMt9GNVgu6fJUOG0UjH3d4kjZPTxFiXd5RnPhUD8Qz1Q2esNVIFfqmrqRD');
        $this->app['config']->set('passona-sdk.passona_team_uuid', '4dc3d890-f63c-11e2-bac2-0a58646002d8');
        $this->app['config']->set('passona-sdk.passona_base_uri', 'https://passona.co.uk/api/2.0/');
    }

    protected function getPackageProviders($app)
    {
        return [
            'Digitonic\PassonaClient\PassonaSDKServiceProvider',
        ];
    }
    /**
     * @param Response $response
     * @return \Digitonic\PassonaClient\Client\
     */
    protected function setupMockedClient(Response $response): \Digitonic\PassonaClient\Client
    {
        $mock = new MockHandler([$response]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        return new \Digitonic\PassonaClient\Client($client);
    }
}
