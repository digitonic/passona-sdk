<?php

namespace Digitonic\PassonaClient\Tests\ContactGroups;

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
            new Response(200, [], '{"238":{"uuid":"f1bdee3e-f704-11e9-95bd-0a58646001ae","name":"SDK Group Updated","description":"Created from the SDK.","created_at":"2019-10-25 09:53:41","updated_at":"2019-10-25 16:21:25","deletable":true,"number_of_contacts":0,"scheduled_jobs_number":0,"status":"Empty","headers":[],"links":[{"rel":"self","uri":"https:\/\/staging.passona.co.uk\/api\/2.0\/contact-groups\/f1bdee3e-f704-11e9-95bd-0a58646001ae"}]}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);
        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function it_can_update_an_existing_contact_group()
    {
        $data = [
            'name' => 'SDK Group Updated'
        ];

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Update($passonaApi);

        $response = $usage->setPayload($data)->put('bedf2e8a-f653-11e9-bcd4-0a58646002d9');

        $this->assertInstanceOf(\stdClass::class, $response);
        $this->assertEquals($data['name'], $response->name);
    }

    /** @test */
    public function it_can_update_an_existing_contact_group_with_setters()
    {
        $name ='SDK Group Updated';

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Update($passonaApi);
        $usage->setName($name);

        $response = $usage->put('bedf2e8a-f653-11e9-bcd4-0a58646002d9');

        $this->assertInstanceOf(\stdClass::class, $response);
        $this->assertEquals($name, $response->name);
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_campaign_uuid_is_missing()
    {
        $data = [
            'name' => 'SDK Group Updated'
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
        $usage->setPayload([])->put('bedf2e8a-f653-11e9-bcd4-0a58646002d9');
    }
}
