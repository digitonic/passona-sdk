<?php

namespace Digitonic\PassonaClient\Tests\Webhooks;

use Digitonic\PassonaClient\Entities\Webhooks\Index;
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
            new Response(200, [], '{"data":[{"name":"Updated Webhook","uuid":"491460ee-fb0d-11e9-a46c-0a586460022b","url":"https:\/\/digitonic.co.uk\/webhook","headers":{"Content-Type":"application\/json"},"links":[{"rel":"self","uri":"https:\/\/staging.passona.co.uk\/api\/2.0\/webhooks\/491460ee-fb0d-11e9-a46c-0a586460022b"}]}],"links":{"first":"https:\/\/staging.passona.co.uk\/api\/2.0\/webhooks?page=1","last":"https:\/\/staging.passona.co.uk\/api\/2.0\/webhooks?page=1","prev":null,"next":null},"meta":{"current_page":1,"from":1,"last_page":1,"path":"https:\/\/staging.passona.co.uk\/api\/2.0\/webhooks","per_page":"20","to":1,"total":1}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);

        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function it_can_retrieve_a_paginated_list_of_webhooks()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Index($passonaApi);

        $response = $usage->paginate(20)->get();

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(3, $response);
        $this->assertEquals(20, $response['meta']->per_page);
    }
}
