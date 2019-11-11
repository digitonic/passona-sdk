<?php

namespace Digitonic\PassonaClient\Tests\Senders;

use Digitonic\PassonaClient\Entities\Senders\Create;
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
            new Response(200, [], '{"data":{"uuid":"c611e89e-fa6a-11e9-b302-0a5864600225","team_id":"","sender":"NewSend","status":"1","created_at":"2019-10-29 16:40:10","updated_at":"2019-10-29 16:40:10","links":[{"rel":"self","uri":"https:\/\/staging.passona.co.uk\/api\/2.0\/senders\/c611e89e-fa6a-11e9-b302-0a5864600225"}]}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);
        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function it_can_create_a_sender_in_passona()
    {
        $data = [
            'sender' => 'NewSend'
        ];

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Create($passonaApi);

        $response = $usage->setPayload($data)->post();

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(1, $response);
        $this->assertEquals($data['sender'], $response['data']->sender);
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
