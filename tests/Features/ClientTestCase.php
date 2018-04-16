<?php


namespace Tests\Feature;


use Digitonic\PassonaClient\Client as PassonaClient;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Tests\MockObjects\MockClient;

class ClientTestCase extends TestCase
{
    /**
     * @var PassonaClient
     */
    protected $client;

    public function setUp()
    {
//        $this->client = new PassonaClient();
//        $client = new Client(['base_uri' => "http://sms.platonic.com/api/external/v1/"]);

        $this->client = new PassonaClient(getenv('ORG_ID'), getenv('API_KEY'), getenv('API_URI'));
    }

}