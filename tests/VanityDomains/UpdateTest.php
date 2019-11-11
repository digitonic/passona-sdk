<?php

namespace Digitonic\PassonaClient\Tests\VanityDomains;

use Digitonic\PassonaClient\Entities\VanityDomains\Update;
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
            new Response(200, [], '{"data":{"uuid":"7ba996f0-fb03-11e9-b29e-0a586460022b","domain":"https:\/\/vaniup.io","dns_status":"Pending Validation","nameservers":"[]","status":"1","created_at":"2019-10-30 10:53:18","updated_at":"2019-10-30 10:55:43","zone_id":"","links":[{"rel":"self","uri":"https:\/\/staging.passona.co.uk\/api\/2.0\/vanity-domains\/7ba996f0-fb03-11e9-b29e-0a586460022b"}]}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);
        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function it_can_update_an_existing_vanity_domain()
    {
        $data = [
            'domain' => 'https://vaniup.io'

        ];

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Update($passonaApi);

        $response = $usage->setPayload($data)->put('7ba996f0-fb03-11e9-b29e-0a586460022b');

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(1, $response);
        $this->assertEquals($data['domain'], $response['data']->domain);
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_vanity_domain_uuid_is_missing()
    {
        $data = [
            'domain' => 'https://vaniup.io'
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
        $usage->setPayload([])->put('7ba996f0-fb03-11e9-b29e-0a586460022b');
    }
}
