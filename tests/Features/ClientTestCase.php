<?php


namespace Tests\Feature;


use Digitonic\PassonaClient\Client as PassonaClient;
use GuzzleHttp\Client;
use Tests\MockObjects\MockClient;

class ClientTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PassonaClient
     */
    protected $client;

    public function setUp()
    {
//        $client = new MockClient();
//        $client = new Client(['base_uri' => "http://sms.platonic.com/api/external/v1/"]);

        $this->client = new PassonaClient(getenv('ORG_ID'), getenv('API_KEY'), getenv('API_URI'));
    }

}