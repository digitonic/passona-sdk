<?php

namespace Digitonic\PassonaClient\Tests\Templates;

use Digitonic\PassonaClient\Entities\Templates\Show;
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
            new Response(200, [], '{"data":{"uuid":"bedf2e8a-f653-11e9-bcd4-0a58646002d9","name":"Testing","body":"test","links":[{"id":5,"uuid":"cbbf2c04-f653-11e9-9025-0a58646002d9","vanity_domain_id":1,"template_id":5,"vanity_domain_uuid":"4d47ca82-f63c-11e9-a674-0a58646002d8","template_uuid":"bedf2e8a-f653-11e9-bcd4-0a58646002d9","name":"test","destination":"http:\/\/www.google.co.uk","created_at":"2019-10-24 12:45:37","updated_at":"2019-10-24 12:45:37"}],"is_locked":false,"sender":"QA_Test_Tea","created_at":"2019-10-24 12:45:15","updated_at":"2019-10-24 12:45:15"}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);

        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function it_can_show_a_specific_contact_group()
    {
        $templateUuid = 'bedf2e8a-f653-11e9-bcd4-0a58646002d9';

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Show($passonaApi);

        $response = $usage->get($templateUuid, false, null);

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(1, $response);
        $this->assertEquals($templateUuid, $response['data']->uuid);
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_identifier_is_missing()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new Show($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->get('', false, null);
    }
}
