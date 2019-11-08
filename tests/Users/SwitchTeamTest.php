<?php

namespace Digitonic\PassonaClient\Tests\Users;

use Digitonic\PassonaClient\Entities\Users\SwitchTeam;
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
class SwitchTeamTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->mock = new MockHandler([
            new Response(200, [], '{"data":{"uuid":"4da54216-f63c-11e9-902c-0a58646002d8","name":"Team Owner","email":"owner@digitonic.co.uk","current_team_id":3,"created_at":"2019-10-24 09:57:27","updated_at":"2019-10-29 10:38:16"}}')
        ]);

        $this->handler = HandlerStack::create($this->mock);

        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function a_user_can_switch_their_active_team_to_a_team_they_are_a_member_of()
    {
        $teamUuid = '4da54216-f63c-11e9-902c-0a58646002d8';

        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new SwitchTeam($passonaApi);

        $response = $usage->get($teamUuid);

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(1, $response);
        $this->assertEquals($teamUuid, $response['data']->uuid);
    }

    /** @test */
    public function it_will_throw_an_exception_if_the_identifier_is_missing()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new SwitchTeam($passonaApi);

        $this->expectException(InvalidData::class);
        $this->expectExceptionCode(422);
        $usage->get('');
    }
}
