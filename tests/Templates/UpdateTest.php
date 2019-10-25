<?php

namespace Digitonic\PassonaClient\Tests\Templates;

use Digitonic\PassonaClient\Entities\Templates\Update;
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
            new Response(200, [], '{"data":{"uuid":"96dc25e4-f709-11e9-967a-0a58646001ac","name":"SDK Template Updated","body":"This template has been updated from the SDK","links":[],"is_locked":false,"sender":"SDK-Sender","created_at":"2019-10-25 10:26:56","updated_at":"2019-10-25 16:37:53"}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);
        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function it_can_update_an_existing_campaign()
    {
        $data = [
            'name' => 'SDK Template Updated',
            'body' => 'This template has been updated from the SDK'
        ];

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Update($passonaApi);

        $response = $usage->put('96dc25e4-f709-11e9-967a-0a58646001ac', $data);

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(1, $response);
        $this->assertEquals($data['name'], $response['data']->name);
        $this->assertEquals($data['body'], $response['data']->body);
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_campaign_uuid_is_missing()
    {
        $data = [
            'name' => 'SDK Template Updated',
            'body' => 'This template has been updated from the SDK'
        ];

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Update($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->put('', $data);
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_update_payload_is_missing()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Update($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->put('bedf2e8a-f653-11e9-bcd4-0a58646002d9', []);
    }
}
