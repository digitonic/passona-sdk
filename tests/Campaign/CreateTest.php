<?php

namespace Digitonic\PassonaClient\Tests\Campaign;

use Digitonic\PassonaClient\Entities\Campaigns\Create;
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
            new Response(200, [], '{"238":{"uuid":"50ce2148-f66d-11e9-bf05-0a58646001a1","team_uuid":"4db7d890-f63c-11e9-afc6-0a58646002d8","name":"SDK MADE","sender":"Digitonic","scheduled_send_date":"2019-11-25 15:25:05","expiry_date":"2019-12-26 15:25:05","status":0,"included_contact_groups":["ab8e21ac-f653-11e9-93bb-1b16546002d9"],"excluded_contact_groups":["4dbbc66c-f63c-11e9-b532-0a58646002d8"],"started_sending_at":"","template_uuid":"cadf2e2a-f241-11e9-bcd4-0a58646002d9","finished_sending_at":"","created_at":"2019-10-24 15:48:17","updated_at":""}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);

        $this->client = new Client(['handler' => $this->handler]);
    }


    /** @test */
    public function it_can_create_a_campaign_via_post()
    {
        $data = [
            "name" => "SDK MADE",
            "sender"=> "Digitonic",
            "scheduled_send_date" => "2019-11-25 15:25:05",
            "expiry_date" => "2019-12-26 15:25:05",
            "included_contact_groups" => ["ab8e21ac-f653-11e9-93bb-1b16546002d9"],
            "excluded_contact_groups" =>  ["4dbbc66c-f63c-11e9-b532-0a58646002d8"],
            "template_uuid" => "cadf2e2a-f241-11e9-bcd4-0a58646002d9"
        ];


        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Create($passonaApi);

        $response = $usage->setPayload($data)->post();

        $this->assertInstanceOf(\stdClass::class, $response);
        $this->assertEquals($data['template_uuid'], $response->template_uuid);
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
