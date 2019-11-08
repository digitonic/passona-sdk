<?php

namespace Digitonic\PassonaClient\Tests\VanityDomains;

use Digitonic\PassonaClient\Entities\VanityDomains\Index;
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
            new Response(200, [], '{"data":[{"uuid":"4d47ca82-f63c-11e9-a674-0a58646002d8","domain":"https:\/\/psms.io","dns_status":"Pending Validation","nameservers":"[]","status":"1","created_at":"2019-10-24 09:57:26","updated_at":"2019-10-24 09:57:26","zone_id":"","links":[{"rel":"self","uri":"https:\/\/staging.passona.co.uk\/api\/2.0\/vanity-domains\/4d47ca82-f63c-11e9-a674-0a58646002d8"}]},{"uuid":"7ba996f0-fb03-11e9-b29e-0a586460022b","domain":"https:\/\/vaniup.io","dns_status":"Pending Validation","nameservers":"[]","status":"1","created_at":"2019-10-30 10:53:18","updated_at":"2019-10-30 10:55:43","zone_id":"","links":[{"rel":"self","uri":"https:\/\/staging.passona.co.uk\/api\/2.0\/vanity-domains\/7ba996f0-fb03-11e9-b29e-0a586460022b"}]}],"links":{"first":"https:\/\/staging.passona.co.uk\/api\/2.0\/vanity-domains?page=1","last":"https:\/\/staging.passona.co.uk\/api\/2.0\/vanity-domains?page=1","prev":null,"next":null},"meta":{"current_page":1,"from":1,"last_page":1,"path":"https:\/\/staging.passona.co.uk\/api\/2.0\/vanity-domains","per_page":"20","to":2,"total":2}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);

        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function it_can_retrieve_a_paginated_list_of_vanity_domains()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Index($passonaApi);

        $response = $usage->paginate(20)->get();

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(3, $response);
        $this->assertEquals(20, $response['meta']->per_page);
    }
}
