<?php

namespace Digitonic\PassonaClient\Tests\Webhooks;

use Digitonic\PassonaClient\Entities\Webhooks\Create;
use Digitonic\PassonaClient\Exceptions\InvalidData;
use Digitonic\PassonaClient\Tests\BaseTestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

/**
 * @property MockHandler mock
 * @property HandlerStack handler
 * @property Client client
 */
class CreateTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->mock = new MockHandler([
            new Response(200, [], '{"238":{"name":"New Webhook","uuid":"491460ee-fb0d-11e9-a46c-0a586460022b","url":"https:\/\/digitonic.co.uk\/webhook","headers":{"Accept":"application\/json"},"links":[{"rel":"self","uri":"https:\/\/staging.passona.co.uk\/api\/2.0\/webhooks\/491460ee-fb0d-11e9-a46c-0a586460022b"}]}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);
        $this->client = new Client(['handler' => $this->handler]);
    }


    /** @test */
    public function it_can_create_a_webhook_in_passona()
    {
        $data = [
            'name' => 'New Webhook',
            'url' => 'https://digitonic.co.uk/webhook',
            'headers' => [
                'Accept' => 'application/json'
            ]
        ];

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Create($passonaApi);

        $response = $usage->setPayload($data)->post();

        $this->assertInstanceOf(\stdClass::class, $response);
        $this->assertEquals($data['name'], $response->name);
        $this->assertEquals($data['url'], $response->url);
    }

    /** @test */
    public function it_can_create_a_webhook_in_passonad_with_setters()
    {
        $name = 'New Webhook';
        $url = 'https://digitonic.co.uk/webhook';
        $headers = [
            'Accept' => 'application/json'
        ];

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Create($passonaApi);
        $usage->setHeaders($headers)
            ->setUrl($url)
            ->setName($name);

        $response = $usage->post();

        $this->assertInstanceOf(\stdClass::class, $response);
        $this->assertEquals($name, $response->name);
        $this->assertEquals($url, $response->url);
    }


    /** @test */
    public function it_will_throw_an_exception_if_the_payload_is_missing()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Create($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->setPayload([])->post();
    }
}
