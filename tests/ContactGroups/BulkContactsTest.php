<?php

namespace Digitonic\PassonaClient\Tests\ContactGroups;

use Digitonic\PassonaClient\Entities\ContactGroups\UploadBulkContacts;
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
class BulkContactsTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->mock = new MockHandler([
            new Response(200, [], '{"data":{"uuid":"f213fd72-f986-11e9-970f-0a58646001df","name":"Bulk Contact Group","description":"A Bulk contact group.","created_at":"2019-10-28 13:29:19","updated_at":"2019-10-28 13:29:19","deletable":true,"number_of_contacts":0,"scheduled_jobs_number":1,"status":"Modifying","headers":[],"links":[{"rel":"self","uri":"https:\/\/staging.passona.co.uk\/api\/2.0\/contact-groups\/f213fd72-f986-11e9-970f-0a58646001df"}]}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);
        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function it_can_create_a_contact_group_and_add_contacts_to_it()
    {
        $data = [
            'name' => 'Bulk Contact Group',
            'description' => 'A Bulk contact group.',
            'contacts' => [
                '447712547874',
                '447758521519'
            ]
        ];

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new UploadBulkContacts($passonaApi);

        $response = $usage->setPayload($data)->post();

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(1, $response);
        $this->assertEquals($data['name'], $response['data']->name);
        $this->assertEquals($data['description'], $response['data']->description);
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_payload_is_missing()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new UploadBulkContacts($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->setPayload([])->post();
    }
}
