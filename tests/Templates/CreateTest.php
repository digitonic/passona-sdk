<?php

namespace Digitonic\PassonaClient\Tests\Templates;

use Digitonic\PassonaClient\Entities\Templates\Create;
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
            new Response(200, [], '{"238":{"uuid":"96dc25e4-f709-11e9-967a-0a58646001ac","name":"SDK Template","body":"This is a template created from the SDK","links":[],"is_locked":false,"sender":"SDK-Sender","created_at":"2019-10-25 10:26:56","updated_at":"2019-10-25 10:26:56"}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);
        $this->client = new Client(['handler' => $this->handler]);
    }


    /** @test */
    public function it_can_create_a_template_in_passona()
    {
        $data = [
            'name' => 'SDK Template',
            'body' => 'This is a template created from the SDK',
            'sender' => 'SDK-Sender'
        ];

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Create($passonaApi);

        $response = $usage->setPayload($data)->post();

        $this->assertInstanceOf(\stdClass::class, $response);
        $this->assertEquals($data['name'], $response->name);
        $this->assertEquals($data['body'], $response->body);
        $this->assertEquals($data['sender'], $response->sender);
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
