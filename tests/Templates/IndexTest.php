<?php

namespace Digitonic\PassonaClient\Tests\Templates;

use Digitonic\PassonaClient\Entities\Templates\Index;
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
            new Response(200, [], '{"data":[{"uuid":"bedf2e8a-f653-11e9-bcd4-0a58646002d9","name":"Testing","body":"test","links":[{"id":5,"uuid":"cbbf2c04-f653-11e9-9025-0a58646002d9","vanity_domain_id":1,"template_id":5,"vanity_domain_uuid":"4d47ca82-f63c-11e9-a674-0a58646002d8","template_uuid":"bedf2e8a-f653-11e9-bcd4-0a58646002d9","name":"test","destination":"http:\/\/www.google.co.uk","created_at":"2019-10-24 12:45:37","updated_at":"2019-10-24 12:45:37"}],"is_locked":false,"sender":"QA_Test_Tea","created_at":"2019-10-24 12:45:15","updated_at":"2019-10-24 12:45:15"}],"links":{"first":"https:\/\/staging.passona.co.uk\/api\/2.0\/templates?page=1","last":"https:\/\/staging.passona.co.uk\/api\/2.0\/templates?page=1","prev":null,"next":null},"meta":{"current_page":1,"from":1,"last_page":1,"path":"https:\/\/staging.passona.co.uk\/api\/2.0\/templates","per_page":"20","to":1,"total":1}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);

        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function it_can_retrieve_a_paginated_list_of_templates()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Index($passonaApi);

        $response = $usage->get(null, true, 20);

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(3, $response);
        $this->assertEquals(20, $response['meta']->per_page);
    }
}
