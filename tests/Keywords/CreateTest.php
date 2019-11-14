<?php

namespace Digitonic\PassonaClient\Tests\Keywords;

use Digitonic\PassonaClient\Entities\Keywords\Create;
use Digitonic\PassonaClient\Exceptions\InvalidData;
use Digitonic\PassonaClient\Tests\BaseTestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Client;

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
            new Response(200, [], '{"238":{"uuid":"cece8728-fa2c-11e9-832a-0a5864600210","keyword":"TestKeyword","message":"This is a test","status":"1","help":"Test Text","add_contact_to_group":true,"contact_groups_uuid":["f213fd72-f986-11e9-970f-0a58646001df"],"call_webhook":false,"webhooks_uuid":[],"links":[{"rel":"self","uri":"https:\/\/staging.passona.co.uk\/api\/2.0\/keywords\/cece8728-fa2c-11e9-832a-0a5864600210"}]}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);

        $this->client = new Client(['handler' => $this->handler]);
    }


    /** @test */
    public function it_can_create_a_keyword_via_post()
    {
        $data = [
            'keyword' => 'TestKeyword',
            'message' => 'This is a test',
            'help' => 'Test Text',
            'add_contact_to_group' => true,
            'call_webhook' => false,
            'contact_groups_uuid' => ['f213fd72-f986-11e9-970f-0a58646001df']
        ];

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Create($passonaApi);

        $response = $usage->setPayload($data)->post();

        $this->assertInstanceOf(\stdClass::class, $response);
        $this->assertEquals($data['keyword'], $response->keyword);
        $this->assertEquals($data['add_contact_to_group'], $response->add_contact_to_group);
    }

    /** @test */
    public function it_can_create_a_keyword_via_post_with_setters()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Create($passonaApi);
        $keyword = 'TestKeyword';
        $message = 'This is a test';
        $usage->setKeyword($keyword)
            ->setMessage($message)
            ->setHelp('Test Text')
            ->setAddContactToGroup(true)
            ->setCallWebhook(false)
            ->setContactGroupsUuid(['f213fd72-f986-11e9-970f-0a58646001df']);

        $response = $usage->post();

        $this->assertInstanceOf(\stdClass::class, $response);
        $this->assertEquals($keyword, $response->keyword);
        $this->assertEquals($message, $response->message);
        $this->assertEquals(true, $response->add_contact_to_group);
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
