<?php

namespace Digitonic\PassonaClient\Tests\Campaign;

use Digitonic\PassonaClient\Entities\Campaigns\Index;
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
class IndexTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->mock = new MockHandler([
            new Response(200, [], '{"data":[{"uuid":"cfb31368-f98a-11e9-9f54-0a58646001df","team_uuid":"4db7d890-f63c-11e9-afc6-0a58646002d8","name":"Campaign Test Send","sender":"Digitonic","scheduled_send_date":"2019-10-28 13:56:59","expiry_date":"2019-10-30 13:56:59","status":2,"included_contact_groups":["47915da0-f63d-11e9-a9c1-0a58646002d8"],"excluded_contact_groups":[],"started_sending_at":"2019-10-28 13:57:01","template_uuid":"79b56ffa-f972-11e9-af8c-0a58646001df","finished_sending_at":"2019-10-28 13:57:02","created_at":"2019-10-28 13:56:59","updated_at":"2019-10-28 13:57:02"}],"links":{"first":"https:\/\/staging.passona.co.uk\/api\/2.0\/campaigns?page=1","last":"https:\/\/staging.passona.co.uk\/api\/2.0\/campaigns?page=1","prev":null,"next":null},"meta":{"current_page":1,"from":1,"last_page":1,"path":"https:\/\/staging.passona.co.uk\/api\/2.0\/campaigns","per_page":"20","to":1,"total":1}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);

        $this->client = new Client(['handler' => $this->handler]);
    }


    /** @test */
    public function it_can_retrieve_a_paginated_list_of_campaigns()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Index($passonaApi);

        $response = $usage->get(null, true, 20);

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(3, $response);
        $this->assertEquals(20, $response['meta']->per_page);
    }
}
