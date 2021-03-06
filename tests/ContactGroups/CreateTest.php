<?php

namespace Digitonic\PassonaClient\Tests\ContactGroups;

use Digitonic\PassonaClient\Entities\ContactGroups\Create;
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
            new Response(200, [], '{"238":{"uuid":"f1bdee3e-f704-11e9-95bd-0a58646001ae","name":"SDK Contact Group","description":"Created from the SDK","created_at":"2019-10-25 09:53:41","updated_at":"2019-10-25 09:53:41","deletable":true,"number_of_contacts":0,"scheduled_jobs_number":0,"status":"Empty","headers":[],"links":[{"rel":"self","uri":"https:\/\/passona.co.uk\/api\/2.0\/contact-groups\/f1bdee3e-f704-11e9-95bd-0a58646001ae"}]}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);
        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function it_can_create_a_contact_group_in_passona()
    {
        $data = [
            "name" => "SDK Contact Group",
            "description"=> "Created from the SDK",
        ];

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Create($passonaApi);

        $response = $usage->setPayload($data)->post();

        $this->assertInstanceOf(\stdClass::class, $response);
        $this->assertEquals($data['name'], $response->name);
        $this->assertEquals($data['description'], $response->description);
    }

    /** @test */
    public function it_can_create_a_contact_group_in_passona_with_setters()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Create($passonaApi);
        $name = 'SDK Contact Group';
        $description = "Created from the SDK";
        $usage->setName($name)
            ->setDescription($description);

        $response = $usage->post();

        $this->assertInstanceOf(\stdClass::class, $response);
        $this->assertEquals($name, $response->name);
        $this->assertEquals($description, $response->description);
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
