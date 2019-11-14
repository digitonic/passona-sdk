<?php

namespace Digitonic\PassonaClient\Tests\Campaign;

use Digitonic\PassonaClient\Entities\Campaigns\SendTest;
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
class SendTestTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->mock = new MockHandler([
            new Response(200, [], '{"238":{"uuid":"cfb31368-f98a-11e9-9f54-0a58646001df","team_uuid":"4db7d890-f63c-11e9-afc6-0a58646002d8","name":"Campaign Test Send","sender":"Digitonic","scheduled_send_date":"2019-10-28 13:56:59","expiry_date":"2019-10-30 13:56:59","status":0,"included_contact_groups":["47915da0-f63d-11e9-a9c1-0a58646002d8"],"excluded_contact_groups":[],"started_sending_at":"","template_uuid":"79b56ffa-f972-11e9-af8c-0a58646001df","finished_sending_at":"","created_at":"2019-10-28 13:56:59","updated_at":""}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);

        $this->client = new Client(['handler' => $this->handler]);
    }


    /** @test */
    public function it_can_create_a_test_campaign_with_one_contact()
    {
        $data = [
            'template_uuid' => '79b56ffa-f972-11e9-af8c-0a58646001df',
            'name' => 'Campaign Test Send',
            'sender' => 'Digitonic',
            'contact_number' => '447758412549',
            'custom_fields' => [
                'first_name' => 'John',
                'last_name' => 'Doe'
            ]
        ];


        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new SendTest($passonaApi);

        $response = $usage->setPayload($data)->post();

        $this->assertInstanceOf(\stdClass::class, $response);
        $this->assertEquals($data['name'], $response->name);
        $this->assertEquals($data['sender'], $response->sender);
        $this->assertEquals($data['template_uuid'], $response->template_uuid);
    }

    /** @test */
    public function it_can_create_a_test_campaign_with_one_contact_using_setters()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new SendTest($passonaApi);

        $name = "Campaign Test Send";
        $sender = 'Digitonic';
        $uuid = '79b56ffa-f972-11e9-af8c-0a58646001df';
        $usage
            ->setName($name)
            ->setSender($sender)
            ->setContactNumber('447758412549')
            ->setCustomFields([
                'first_name' => 'John',
                'last_name' => 'Doe'
            ])
            ->setTemplateUuid($uuid);

        $response = $usage->post();

        $this->assertInstanceOf(\stdClass::class, $response);
        $this->assertEquals($name, $response->name);
        $this->assertEquals($sender, $response->sender);
        $this->assertEquals($uuid, $response->template_uuid);
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_payload_is_missing()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new SendTest($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->setPayload([])->post();
    }
}
