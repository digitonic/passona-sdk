<?php

namespace Digitonic\PassonaClient\Tests\Users;

use Digitonic\PassonaClient\Entities\Users\SyncGroups;
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
class SyncGroupsTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->mock = new MockHandler([
            new Response(200, [], '[]')
        ]);

        $this->handler = HandlerStack::create($this->mock);

        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function it_can_sync_a_contact_to_a_contact_group()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new SyncGroups($passonaApi);

        $data = [
            'groups' => [
                '3e70c8e0-fbd4-11e9-993f-0a586460024f',
                '4a109a68-fbd4-11e9-a9aa-0a586460024f'
            ],
            'contact' => '447715898521'
        ];

        $response = $usage->setPayload($data)->post();
        $this->assertEquals($response->count(), 0);
    }

    /** @test */
    public function it_will_throw_an_exception_if_payload_is_missing()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new SyncGroups($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->setPayload([])->post();
    }
}
