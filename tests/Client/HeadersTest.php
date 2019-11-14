<?php

namespace Digitonic\PassonaClient\Tests\Client;

use Digitonic\PassonaClient\Entities\Campaigns\Create;
use Digitonic\PassonaClient\Tests\BaseTestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

/**
 * @property MockHandler mock
 * @property HandlerStack handler
 * @property Client client
 */
class HeadersTest extends BaseTestCase
{
    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->mock = new MockHandler([
            new Response(200, [], '{"238":{"uuid":"50ce2148-f66d-11e9-bf05-0a58646001a1","team_uuid":"4db7d890-f63c-11e9-afc6-0a58646002d8","name":"SDK MADE","sender":"Digitonic","scheduled_send_date":"2019-11-25 15:25:05","expiry_date":"2019-12-26 15:25:05","status":0,"included_contact_groups":["ab8e21ac-f653-11e9-93bb-1b16546002d9"],"excluded_contact_groups":["4dbbc66c-f63c-11e9-b532-0a58646002d8"],"started_sending_at":"","template_uuid":"cadf2e2a-f241-11e9-bcd4-0a58646002d9","finished_sending_at":"","created_at":"2019-10-24 15:48:17","updated_at":""}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);
        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function the_client_will_use_the_env_key_by_default()
    {
        Config::set('passona-sdk.passona_api_key', 'a_random_api_key');
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Create($passonaApi);
        $reflect = new \ReflectionClass(Create::class);

        $reflectionProperty = $reflect->getProperty('headers');
        $reflectionProperty->setAccessible(true);
        $results = $reflectionProperty->getValue($usage);

        if ($results['Authorization']) {
            $words = explode(" ", $results['Authorization']);
            $this->assertSame(Config::get('passona-sdk.passona_api_key'), $words[1]);
        }
    }

    /** @test */
    public function the_set_headers_function_will_override_the_auth_headers_bearer_token()
    {
        Config::set('passona-sdk.passona_api_key', 'a_random_api_key');
        $testApiToken = 'i-am-a-new-token';

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Create($passonaApi);
        $usage->setHeaders([
            'Authorization' => "Bearer {$testApiToken}"
        ]);

        $reflect = new \ReflectionClass(Create::class);

        $reflectionProperty = $reflect->getProperty('headers');
        $reflectionProperty->setAccessible(true);
        $results = $reflectionProperty->getValue($usage);

        if ($results['Authorization']) {
            $words = explode(" ", $results['Authorization']);
            $this->assertNotSame(Config::get('passona-sdk.passona_api_key'), $words[1]);
            $this->assertSame($testApiToken, $words[1]);
        }
    }
}
