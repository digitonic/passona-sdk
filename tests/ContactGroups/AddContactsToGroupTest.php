<?php

namespace Digitonic\PassonaClient\Tests\ContactGroups;

use Digitonic\PassonaClient\Entities\ContactGroups\AddContacts;
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
class AddContactsToGroupTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->mock = new MockHandler([
            new Response(200, [], '{"data":{"uuid":"f1bdee3e-f704-11e9-95bd-0a58646001ae","name":"SDK Group","description":"Created from the SDK.","created_at":"2019-10-25 09:53:41","updated_at":"2019-10-28 11:19:38","deletable":true,"number_of_contacts":0,"scheduled_jobs_number":1,"status":"Modifying","headers":[],"links":[{"rel":"self","uri":"https:\/\/staging.passona.co.uk\/api\/2.0\/contact-groups\/f1bdee3e-f704-11e9-95bd-0a58646001ae"}]}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);
        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function it_can_add_a_contact_to_a_contact_group()
    {
        $groupUuid = 'f1bdee3e-f704-11e9-95bd-0a58646001ae';

        $data = [
            'contacts' => [
                [
                    'phone_number' => '447751256582'
                ]
            ]
        ];

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new AddContacts($passonaApi);

        $response = $usage->setPayload($data)->put($groupUuid);

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(1, $response);
        $this->assertEquals($groupUuid, $response['data']->uuid);
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_identifier_is_missing()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new AddContacts($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->setPayload(['some' => 'data'])->put('');
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_payload_is_missing()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new AddContacts($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->setPayload([])->put('f1bdee3e-f704-11e9-95bd-0a58646001ae');
    }
}
