<?php

namespace Digitonic\PassonaClient\Tests\VanityDomains;

use Digitonic\PassonaClient\Entities\VanityDomains\Create;
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
class CreateTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->mock = new MockHandler([
            new Response(200, [], '{"238":{"uuid":"7ba996f0-fb03-11e9-b29e-0a586460022b","domain":"https:\/\/vani.io","dns_status":"Pending Validation","nameservers":"[]","status":"1","created_at":"2019-10-30 10:53:18","updated_at":"2019-10-30 10:53:18","zone_id":"","links":[{"rel":"self","uri":"https:\/\/staging.passona.co.uk\/api\/2.0\/vanity-domains\/7ba996f0-fb03-11e9-b29e-0a586460022b"}]}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);
        $this->client = new Client(['handler' => $this->handler]);
    }


    /** @test */
    public function it_can_create_a_vanity_domain_in_passona()
    {
        $data = [
            'domain' => 'https://vani.io'
        ];

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Create($passonaApi);

        $response = $usage->setPayload($data)->post();

        $this->assertInstanceOf(\stdClass::class, $response);
        $this->assertEquals($data['domain'], $response->domain);
    }

    /** @test */
    public function it_can_create_a_vanity_domain_in_passona_with_setters()
    {
        $domain = 'https://vani.io';

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Create($passonaApi);
        $usage->setDomain($domain);

        $response = $usage->post();

        $this->assertInstanceOf(\stdClass::class, $response);
        $this->assertEquals($domain, $response->domain);
    }


    /** @test */
    public function it_will_throw_an_exception_if_the_payload_is_missing()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Create($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->setPayload([])->post();
    }
}
