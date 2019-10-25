<?php

namespace Digitonic\PassonaClient\Tests\ContactGroups;

use Digitonic\PassonaClient\Entities\ContactGroups\Create;
use Digitonic\PassonaClient\Tests\BaseTestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class CreateTest extends BaseTestCase
{
    /** @test */
    public function it_can_create_a_contact_group_in_passona()
    {
        $mock = new MockHandler([
            new Response(200, [], '{"data":{"uuid":"f1bdee3e-f704-11e9-95bd-0a58646001ae","name":"SDK Contact Group","description":"Created from the SDK","created_at":"2019-10-25 09:53:41","updated_at":"2019-10-25 09:53:41","deletable":true,"number_of_contacts":0,"scheduled_jobs_number":0,"status":"Empty","headers":[],"links":[{"rel":"self","uri":"https:\/\/passona.co.uk\/api\/2.0\/contact-groups\/f1bdee3e-f704-11e9-95bd-0a58646001ae"}]}}
')
        ]);

        $data = [
            "name" => "SDK Contact Group",
            "description"=> "Created from the SDK",
        ];

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $passonaApi = new \Digitonic\PassonaClient\Client($client);

        $usage = new Create($passonaApi);

        $response = $usage->post($data);

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(1, $response);
        $this->assertEquals($data['name'], $response['data']->name);
        $this->assertEquals($data['description'], $response['data']->description);
    }
}
