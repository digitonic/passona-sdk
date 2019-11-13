<?php

namespace Digitonic\PassonaClient\Tests\Senders;

use Digitonic\PassonaClient\Entities\Senders\Update;
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
            new Response(200, [], '{"238":{"uuid":"c611e89e-fa6a-11e9-b302-0a5864600225","team_id":"","sender":"NewSendUp","status":"1","created_at":"2019-10-29 16:40:10","updated_at":"2019-10-29 16:40:10","links":[{"rel":"self","uri":"https:\/\/staging.passona.co.uk\/api\/2.0\/senders\/c611e89e-fa6a-11e9-b302-0a5864600225"}]}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);
        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function it_can_create_a_sender_in_passona()
    {
        $senderUuid = 'c611e89e-fa6a-11e9-b302-0a5864600225';

        $data = [
            'sender' => 'NewSendUp'
        ];

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Update($passonaApi);

        $response = $usage->setPayload($data)->put($senderUuid);

        $this->assertInstanceOf(\stdClass::class, $response);
        $this->assertEquals($senderUuid, $response->uuid);
        $this->assertEquals($data['sender'], $response->sender);
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_sender_uuid_is_missing()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Update($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->setPayload(['some' => 'data'])->put('');
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_payload_is_missing()
    {
        $senderUuid = 'c611e89e-fa6a-11e9-b302-0a5864600225';

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Update($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->setPayload([])->put($senderUuid);
    }
}
