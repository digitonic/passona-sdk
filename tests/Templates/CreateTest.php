<?php

namespace Digitonic\PassonaClient\Tests\Templates;

use Digitonic\PassonaClient\Entities\Templates\Create;
use Digitonic\PassonaClient\Tests\BaseTestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class CreateTest extends BaseTestCase
{
    /** @test */
    public function it_can_create_a_template_in_passona()
    {
        $mock = new MockHandler([
            new Response(200, [], '{"data":{"uuid":"96dc25e4-f709-11e9-967a-0a58646001ac","name":"SDK Template","body":"This is a template created from the SDK","links":[],"is_locked":false,"sender":"SDK-Sender","created_at":"2019-10-25 10:26:56","updated_at":"2019-10-25 10:26:56"}}')
        ]);

        $data = [
            'name' => 'SDK Template',
            'body' => 'This is a template created from the SDK',
            'sender' => 'SDK-Sender'
        ];

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $passonaApi = new \Digitonic\PassonaClient\Client($client);

        $usage = new Create($passonaApi);

        $response = $usage->post($data);

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(1, $response);
        $this->assertEquals($data['name'], $response['data']->name);
        $this->assertEquals($data['body'], $response['data']->body);
        $this->assertEquals($data['sender'], $response['data']->sender);
    }
}
