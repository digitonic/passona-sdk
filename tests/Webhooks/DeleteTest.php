<?php

namespace Digitonic\PassonaClient\Tests\Webhooks;

use Digitonic\PassonaClient\Entities\Webhooks\Delete;
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
class DeleteTest extends BaseTestCase
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
    public function it_can_delete_a_webhook_in_passona()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Delete($passonaApi);

        $response = $usage->delete('491460ee-fb0d-11e9-a46c-0a586460022b');

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(0, $response);
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_webhook_uuid_is_missing()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Delete($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->delete('');
    }
}
