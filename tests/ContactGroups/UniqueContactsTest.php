<?php

namespace Digitonic\PassonaClient\Tests\ContactGroups;

use Digitonic\PassonaClient\Entities\ContactGroups\UniqueContacts;
use Digitonic\PassonaClient\Tests\BaseTestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;

/**
 * @property MockHandler mock
 * @property HandlerStack handler
 * @property Client client
 */
class UniqueContactsTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->mock = new MockHandler([
            new Response(200, [], '{"data":[{"phone_number":"447123456789","created_at":"2018-11-20 16:24:14"},{"phone_number":"447987654321","created_at":"2018-11-20 16:30:01"}]}')
        ]);

        $this->handler = HandlerStack::create($this->mock);
        $this->client = new Client(['handler' => $this->handler]);
    }

    /** @test */
    public function can_get_unique_contacts_from_group()
    {
        $passonaApi = new \Digitonic\PassonaClient\Client($this->client);

        $usage = new UniqueContacts($passonaApi);

        $response = $usage
            ->setIncludedContactGroupUuids(['8747eaf4-0ab0-11ea-bcbd-0242ac140007'])
            ->setExcludedContactGroupUuids(['640ae1ae-0ab0-11ea-b97c-0242ac140007'])
            ->post();

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(2, $response);
    }
}
