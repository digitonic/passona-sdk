<?php

namespace Digitonic\PassonaClient\Tests\ContactGroups;

use Digitonic\PassonaClient\Entities\ContactGroups\Index;
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
            new Response(200, [], '{"data":[{"uuid":"f213fd72-f986-11e9-970f-0a58646001df","name":"Bulk Contact Group","description":"A Bulk contact group.","created_at":"2019-10-28 13:29:19","updated_at":"2019-10-28 13:29:20","deletable":true,"number_of_contacts":2,"scheduled_jobs_number":0,"status":"Ready","headers":[],"links":[{"rel":"self","uri":"https:\/\/staging.passona.co.uk\/api\/2.0\/contact-groups\/f213fd72-f986-11e9-970f-0a58646001df"}]}],"links":{"first":"https:\/\/staging.passona.co.uk\/api\/2.0\/contact-groups?page=1","last":"https:\/\/staging.passona.co.uk\/api\/2.0\/contact-groups?page=1","prev":null,"next":null},"meta":{"current_page":1,"from":1,"last_page":1,"path":"https:\/\/staging.passona.co.uk\/api\/2.0\/contact-groups","per_page":"20","to":1,"total":1}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);

        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function it_can_retrieve_a_paginated_list_of_templates()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Index($passonaApi);

        $response = $usage->paginate(20)->get();

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(3, $response);
        $this->assertEquals(20, $response['meta']->per_page);
    }
}
