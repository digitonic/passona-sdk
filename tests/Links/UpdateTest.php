<?php

namespace Digitonic\PassonaClient\Tests\Links;

use Digitonic\PassonaClient\Entities\Links\Update;
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
class UpdateTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->mock = new MockHandler([
            new Response(200, [], '{"data":{"uuid":"85f7b244-faf5-11e9-a5d9-0a5864600115","vanity_domain_uuid":"4d47ca82-f63c-11e9-a674-0a58646002d8","template_uuid":"ae17d458-fa63-11e9-83fe-0a58646001fd","name":"New Link Updated","destination":"https:\/\/digitonic.co.uk\/update","created_at":"2019-10-30 09:13:23","updated_at":"2019-10-30 09:18:54"}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);
        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function it_can_update_an_existing_link()
    {
        $data = [
            'name' => 'New Link Updated',
            'destination' => 'https://digitonic.co.uk/update'
        ];

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Update($passonaApi);

        $response = $usage->setPayload($data)->put('85f7b244-faf5-11e9-a5d9-0a5864600115');

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(1, $response);
        $this->assertEquals($data['name'], $response['data']->name);
        $this->assertEquals($data['destination'], $response['data']->destination);
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_link_uuid_is_missing()
    {
        $data = [
            'name' => 'New Link Updated',
            'destination' => 'https://digitonic.co.uk/update'
        ];

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Update($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->setPayload($data)->put('');
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_update_payload_is_missing()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Update($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->setPayload([])->put('85f7b244-faf5-11e9-a5d9-0a5864600115');
    }
}
