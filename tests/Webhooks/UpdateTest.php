<?php

namespace Digitonic\PassonaClient\Tests\Webhooks;

use Digitonic\PassonaClient\Entities\Webhooks\Update;
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
class UpdateTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->mock = new MockHandler([
            new Response(200, [], '{"238":{"name":"Updated Webhook","uuid":"491460ee-fb0d-11e9-a46c-0a586460022b","url":"https:\/\/digitonic.co.uk\/webhook","headers":{"Content-Type":"application\/json"},"links":[{"rel":"self","uri":"https:\/\/staging.passona.co.uk\/api\/2.0\/webhooks\/491460ee-fb0d-11e9-a46c-0a586460022b"}]}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);
        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function it_can_update_an_existing_webhooks()
    {
        $data = [
            'name' => 'Updated Webhook',
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ];

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Update($passonaApi);

        $response = $usage->setPayload($data)->put('491460ee-fb0d-11e9-a46c-0a586460022b');

        $this->assertInstanceOf(\stdClass::class, $response);
        $this->assertEquals($data['name'], $response->name);
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_webhook_uuid_is_missing()
    {
        $data = [
            'name' => 'Updated Webhook',
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ];

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Update($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->setPayload($data)->put('');
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_update_payload_is_missing()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Update($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->setPayload([])->put('491460ee-fb0d-11e9-a46c-0a586460022b');
    }
}
