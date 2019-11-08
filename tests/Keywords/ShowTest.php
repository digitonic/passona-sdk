<?php

namespace Digitonic\PassonaClient\Tests\Keywords;

use Digitonic\PassonaClient\Entities\Keywords\Show;
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
class ShowTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->mock = new MockHandler([
            new Response(200, [], '{"data":{"uuid":"cece8728-fa2c-11e9-832a-0a5864600210","keyword":"TestKeyword","message":"This is a test","status":"1","help":"Test Text","add_contact_to_group":true,"contact_groups_uuid":["f213fd72-f986-11e9-970f-0a58646001df"],"call_webhook":false,"webhooks_uuid":[],"links":[{"rel":"self","uri":"https:\/\/staging.passona.co.uk\/api\/2.0\/keywords\/cece8728-fa2c-11e9-832a-0a5864600210"}]}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);

        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function it_can_show_a_specific_keyword()
    {
        $keywordUuid = 'cece8728-fa2c-11e9-832a-0a5864600210';

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Show($passonaApi);

        $response = $usage->get($keywordUuid);

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(1, $response);
        $this->assertEquals($keywordUuid, $response['data']->uuid);

    }

    /** @test */
    public function it_will_throw_an_exception_if_the_identifier_is_missing()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Show($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->get('');
    }
}
