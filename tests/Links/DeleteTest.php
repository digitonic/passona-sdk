<?php

namespace Digitonic\PassonaClient\Tests\Links;

use Digitonic\PassonaClient\Entities\Links\Delete;
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
    public function it_can_delete_a_keyword_in_passona()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Delete($passonaApi);

        $response = $usage->delete('85f7b244-faf5-11e9-a5d9-0a5864600115');

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(0, $response);
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_keyword_uuid_is_missing()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Delete($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->delete('');
    }
}
