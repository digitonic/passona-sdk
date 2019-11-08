<?php

namespace Digitonic\PassonaClient\Tests\Senders;

use Digitonic\PassonaClient\Entities\Senders\Index;
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
            new Response(200, [], '{"data":[{"uuid":"4db96e30-f63c-11e9-83f9-0a58646002d8","team_id":"","sender":"QA_Test_Tea","status":"1","created_at":"2019-10-24 09:57:27","updated_at":"2019-10-24 09:57:27","links":[{"rel":"self","uri":"https:\/\/staging.passona.co.uk\/api\/2.0\/senders\/4db96e30-f63c-11e9-83f9-0a58646002d8"}]},{"uuid":"4d3c59c2-f63c-11e9-a22b-0a58646002d8","team_id":"","sender":"884400","status":"1","created_at":"2019-10-24 09:57:26","updated_at":"2019-10-24 09:57:26","links":[{"rel":"self","uri":"https:\/\/staging.passona.co.uk\/api\/2.0\/senders\/4d3c59c2-f63c-11e9-a22b-0a58646002d8"}]},{"uuid":"02e8187e-fa6b-11e9-94c2-0a5864600225","team_id":"","sender":"NewSendUp","status":"1","created_at":"2019-10-29 16:41:52","updated_at":"2019-10-29 16:43:30","links":[{"rel":"self","uri":"https:\/\/staging.passona.co.uk\/api\/2.0\/senders\/02e8187e-fa6b-11e9-94c2-0a5864600225"}]}],"links":{"first":"https:\/\/staging.passona.co.uk\/api\/2.0\/senders?page=1","last":"https:\/\/staging.passona.co.uk\/api\/2.0\/senders?page=1","prev":null,"next":null},"meta":{"current_page":1,"from":1,"last_page":1,"path":"https:\/\/staging.passona.co.uk\/api\/2.0\/senders","per_page":"20","to":3,"total":3}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);

        $this->client = new Client(['handler' => $this->handler]);
    }


    /** @test */
    public function it_can_retrieve_a_paginated_list_of_senders()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Index($passonaApi);

        $response = $usage->paginate(20)->get();

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(3, $response);
        $this->assertEquals(20, $response['meta']->per_page);
    }
}
