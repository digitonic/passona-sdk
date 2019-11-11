<?php

namespace Digitonic\PassonaClient\Tests\Campaign;

use Digitonic\PassonaClient\Entities\Campaigns\Update;
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
            new Response(200, [], '{"data":{"uuid":"5662af3c-f70f-11e9-84ad-0a5864600e04","team_uuid":"4db7d890-f63c-11e9-afc6-0a58646002d8","name":"Update SDK","sender":"Digitonic","scheduled_send_date":"2019-11-25 15:25:05","expiry_date":"2019-12-26 15:25:05","status":0,"included_contact_groups":[],"excluded_contact_groups":[],"started_sending_at":"","template_uuid":"afc52e8a-f653-12a2-bcd4-0a58646002d9","finished_sending_at":"","created_at":"2019-10-25 11:08:05","updated_at":""}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);
        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function it_can_update_an_existing_campaign()
    {
        $data = [
            'name' => 'Update SDK',
            'template_uuid' => 'afc52e8a-f653-12a2-bcd4-0a58646002d9'
        ];

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Update($passonaApi);

        $response = $usage->setPayload($data)->put('bedf2e8a-f653-11e9-bcd4-0a58646002d9');

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(1, $response);
        $this->assertEquals($data['name'], $response['data']->name);
        $this->assertEquals($data['template_uuid'], $response['data']->template_uuid);
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_campaign_uuid_is_missing()
    {
        $data = [
            'name' => 'Update SDK',
            'template_uuid' => 'afc52e8a-f653-12a2-bcd4-0a58646002d9'
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
        $usage->setPayload([])->put('bedf2e8a-f653-11e9-bcd4-0a58646002d9');
    }
}
