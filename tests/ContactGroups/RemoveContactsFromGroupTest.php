<?php

namespace Digitonic\PassonaClient\Tests\ContactGroups;

use Digitonic\PassonaClient\Entities\ContactGroups\RemoveContacts;
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
class RemoveContactsFromGroupTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->mock = new MockHandler([
            new Response(200, [], '{"238":{"uuid":"f1bdee3e-f704-11e9-95bd-0a58646001ae","name":"SDK Group Updated","description":"Created from the SDK.","created_at":"2019-10-25 09:53:41","updated_at":"2019-10-28 11:48:47","deletable":true,"number_of_contacts":1,"scheduled_jobs_number":1,"status":"Modifying","headers":[],"links":[{"rel":"self","uri":"https:\/\/staging.passona.co.uk\/api\/2.0\/contact-groups\/f1bdee3e-f704-11e9-95bd-0a58646001ae"}]}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);
        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function it_can_remove_a_contact_to_a_contact_group()
    {
        $groupUuid = 'f1bdee3e-f704-11e9-95bd-0a58646001ae';

        $data = [
            'phone_numbers' => [
                '447751256582'
            ]
        ];

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new RemoveContacts($passonaApi);

        $response = $usage->setPayload($data)->put($groupUuid);

        $this->assertInstanceOf(\stdClass::class, $response);
        $this->assertEquals($groupUuid, $response->uuid);
    }

    /** @test */
    public function it_can_remove_a_contact_to_a_contact_group_with_setters()
    {
        $groupUuid = 'f1bdee3e-f704-11e9-95bd-0a58646001ae';

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new RemoveContacts($passonaApi);
        $usage->setPhoneNumbers([
            '447751256582'
        ]);

        $response = $usage->put($groupUuid);

        $this->assertInstanceOf(\stdClass::class, $response);
        $this->assertEquals($groupUuid, $response->uuid);
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_identifier_is_missing()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new RemoveContacts($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->setPayload(['some' => 'data'])->put('');
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_payload_is_missing()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new RemoveContacts($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->setPayload([])->put('f1bdee3e-f704-11e9-95bd-0a58646001ae');
    }
}
