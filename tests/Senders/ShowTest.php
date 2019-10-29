<?php

namespace Digitonic\PassonaClient\Tests\Senders;

use Digitonic\PassonaClient\Entities\Senders\Show;
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
class ShowTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->mock = new MockHandler([
            new Response(200, [], '{"data":{"uuid":"02e8187e-fa6b-11e9-94c2-0a5864600225","team_id":"","sender":"NewSendUp","status":"1","created_at":"2019-10-29 16:41:52","updated_at":"2019-10-29 16:43:30","links":[{"rel":"self","uri":"https:\/\/staging.passona.co.uk\/api\/2.0\/senders\/02e8187e-fa6b-11e9-94c2-0a5864600225"}]}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);

        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function it_can_show_a_specific_sender()
    {
        $senderUuid = '02e8187e-fa6b-11e9-94c2-0a5864600225';

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Show($passonaApi);

        $response = $usage->get($senderUuid, false, null);

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(1, $response);
        $this->assertEquals($senderUuid, $response['data']->uuid);

    }

    /** @test */
    public function it_will_throw_an_exception_if_the_identifier_is_missing()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Show($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->get('', false, null);
    }
}
