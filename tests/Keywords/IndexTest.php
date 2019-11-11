<?php

namespace Digitonic\PassonaClient\Tests\Keywords;

use Digitonic\PassonaClient\Entities\Keywords\Index;
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
            new Response(200, [], '{"data":[{"uuid":"cece8728-fa2c-11e9-832a-0a5864600210","keyword":"TestKeyword","message":"This is a test","status":"1","help":"Test Text","add_contact_to_group":true,"contact_groups_uuid":["f213fd72-f986-11e9-970f-0a58646001df"],"call_webhook":false,"webhooks_uuid":[],"links":[{"rel":"self","uri":"https:\/\/staging.passona.co.uk\/api\/2.0\/keywords\/cece8728-fa2c-11e9-832a-0a5864600210"}]},{"uuid":"96e72962-f65f-11e9-9a85-0a58646002d9","keyword":"Testingkey","message":"Test","status":"1","help":"HELP","add_contact_to_group":true,"contact_groups_uuid":[],"call_webhook":false,"webhooks_uuid":["93ce0e94-f65f-11e9-8880-0a58646002d8"],"links":[{"rel":"self","uri":"https:\/\/staging.passona.co.uk\/api\/2.0\/keywords\/96e72962-f65f-11e9-9a85-0a58646002d9"}]}],"links":{"first":"https:\/\/staging.passona.co.uk\/api\/2.0\/keywords?page=1","last":"https:\/\/staging.passona.co.uk\/api\/2.0\/keywords?page=1","prev":null,"next":null},"meta":{"current_page":1,"from":1,"last_page":1,"path":"https:\/\/staging.passona.co.uk\/api\/2.0\/keywords","per_page":"20","to":2,"total":2}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);

        $this->client = new Client(['handler' => $this->handler]);
    }


    /** @test */
    public function it_can_retrieve_a_paginated_list_of_keywords()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Index($passonaApi);

        $response = $usage->paginate()->get();

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(3, $response);
        $this->assertEquals(20, $response['meta']->per_page);
    }
}
