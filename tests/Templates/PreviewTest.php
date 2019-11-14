<?php

namespace Digitonic\PassonaClient\Tests\Templates;

use Digitonic\PassonaClient\Entities\Templates\Preview;
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
class PreviewTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->mock = new MockHandler([
            new Response(200, [], '{"238":{"uuid":"79b56ffa-f972-11e9-af8c-0a58646001df","name":"SDK Template Updated REGEX YALL","body":"This template has been updated from the SDK","links":[],"is_locked":false,"sender":"SDK-Sender","created_at":"2019-10-28 11:02:47","updated_at":"2019-10-28 11:03:44"}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);
        $this->client = new Client(['handler' => $this->handler]);
    }


    /** @test */
    public function it_can_create_get_a_preview_of_a_template()
    {
        $templateUuid = '79b56ffa-f972-11e9-af8c-0a58646001df';

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Preview($passonaApi);

        $response = $usage->get($templateUuid);

        $this->assertInstanceOf(\stdClass::class, $response);
        $this->assertEquals($templateUuid, $response->uuid);
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_payload_is_missing()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Preview($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->get('');
    }
}
