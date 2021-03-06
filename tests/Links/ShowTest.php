<?php

namespace Digitonic\PassonaClient\Tests\Links;

use Digitonic\PassonaClient\Entities\Links\Show;
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
class ShowTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->mock = new MockHandler([
            new Response(200, [], '{"238":{"uuid":"85f7b244-faf5-11e9-a5d9-0a5864600115","vanity_domain_uuid":"4d47ca82-f63c-11e9-a674-0a58646002d8","template_uuid":"ae17d458-fa63-11e9-83fe-0a58646001fd","name":"New Link","destination":"https:\/\/digitonic.co.uk","created_at":"2019-10-30 09:13:23","updated_at":"2019-10-30 09:13:23"}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);

        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function it_can_show_a_specific_keyword()
    {
        $linkUuid = '85f7b244-faf5-11e9-a5d9-0a5864600115';

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Show($passonaApi);

        $response = $usage->get($linkUuid);

        $this->assertInstanceOf(\stdClass::class, $response);
        $this->assertEquals($linkUuid, $response->uuid);
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_identifier_is_missing()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Show($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->get('');
    }
}
