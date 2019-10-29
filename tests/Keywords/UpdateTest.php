<?php

namespace Digitonic\PassonaClient\Tests\Keywords;

use Digitonic\PassonaClient\Entities\ContactGroups\Update;
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
            new Response(200, [], '{"data":{"uuid":"cece8728-fa2c-11e9-832a-0a5864600210","keyword":"TestKeywordUpdated","message":"This is an update","status":"1","help":"Update Text","add_contact_to_group":true,"contact_groups_uuid":["f213fd72-f986-11e9-970f-0a58646001df"],"call_webhook":false,"webhooks_uuid":[],"links":[{"rel":"self","uri":"https:\/\/staging.passona.co.uk\/api\/2.0\/keywords\/cece8728-fa2c-11e9-832a-0a5864600210"}]}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);
        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function it_can_update_an_existing_keyword()
    {
        $data = [
            'keyword' => 'TestKeywordUpdated',
            'message' => 'This is an update',
            'help' => 'Update Text',
        ];

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Update($passonaApi);

        $response = $usage->put('cece8728-fa2c-11e9-832a-0a5864600210', $data);

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(1, $response);
        $this->assertEquals($data['keyword'], $response['data']->keyword);
        $this->assertEquals($data['message'], $response['data']->message);
        $this->assertEquals($data['help'], $response['data']->help);
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_keyword_uuid_is_missing()
    {
        $data = [
            'name' => 'SDK Group Updated'
        ];

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Update($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->put('', $data);
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_update_payload_is_missing()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Update($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->put('cece8728-fa2c-11e9-832a-0a5864600210', []);
    }
}
