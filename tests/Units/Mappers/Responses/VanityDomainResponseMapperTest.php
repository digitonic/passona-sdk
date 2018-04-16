<?php

namespace Tests\Unit\Mappers\Responses;

use Digitonic\PassonaClient\Entities\VanityDomainResponse;
use Digitonic\PassonaClient\Mappers\Responses\VanityDomainResponseMapper;
use PHPUnit\Framework\TestCase;

/**
 * @property VanityDomainResponseMapper mapper
 * @property VanityDomainResponse vanityDomainResponse
 */
class VanityDomainResponseMapperTest extends TestCase
{
    public function setUp()
    {
        $this->mapper = new VanityDomainResponseMapper();

        $this->vanityDomainResponse = new VanityDomainResponse();
        $this->vanityDomainResponse->setId(1);
        $this->vanityDomainResponse->setNameservers(['nameserver1', 'nameserver2']);
        $this->vanityDomainResponse->setDomain('domain.com');
        $this->vanityDomainResponse->setHostedZoneId('1A2B3C4D');
        $this->vanityDomainResponse->setStatus(1);
    }

    /** @test */
    public function toArray()
    {
        $expected = [
            'id' => 1,
            'domain' => 'domain.com',
            'hostedZoneId' => '1A2B3C4D',
            'status' => 1,
            'nameservers' => ['nameserver1','nameserver2']
        ];

        $this->assertEquals($expected, $this->mapper->toArray($this->vanityDomainResponse));
    }

    /** @test */
    public function fromArray()
    {
        $vanityDomainResponse = [
            'id' => 1,
            'domain' => 'domain.com',
            'hostedZoneId' => '1A2B3C4D',
            'status' => 1,
            'nameservers' => ['nameserver1','nameserver2']
        ];

        $this->assertEquals($this->vanityDomainResponse, $this->mapper->fromArray($vanityDomainResponse, VanityDomainResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_array()
    {
        $vanityDomainResponse = [
            'id' => 1,
            'domain' => 'domain.com',
            'hostedZoneId' => '1A2B3C4D',
            'status' => 1,
            'nameservers' => ['nameserver1','nameserver2']
        ];

        $this->assertEquals($vanityDomainResponse, $this->mapper->toArray($this->mapper->fromArray($vanityDomainResponse, VanityDomainResponse::class)));
    }

    /** @test */
    public function toStdClass()
    {
        $expected = new \stdClass();
        $expected->id = 1;
        $expected->domain = 'domain.com';
        $expected->hostedZoneId = '1A2B3C4D';
        $expected->status = 1;
        $expected->nameservers = ['nameserver1','nameserver2'];

        $this->assertEquals($expected, $this->mapper->toStdClass($this->vanityDomainResponse));
    }

    /** @test */
    public function fromStdClass()
    {
        $vanityDomainResponse = new \stdClass();
        $vanityDomainResponse->id = 1;
        $vanityDomainResponse->domain = 'domain.com';
        $vanityDomainResponse->hostedZoneId = '1A2B3C4D';
        $vanityDomainResponse->status = 1;
        $vanityDomainResponse->nameservers = ['nameserver1','nameserver2'];

        $this->assertEquals($this->vanityDomainResponse, $this->mapper->fromStdClass($vanityDomainResponse, VanityDomainResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_stdClass()
    {
        $vanityDomainResponse = new \stdClass();
        $vanityDomainResponse->id = 1;
        $vanityDomainResponse->domain = 'domain.com';
        $vanityDomainResponse->hostedZoneId = '1A2B3C4D';
        $vanityDomainResponse->status = 1;
        $vanityDomainResponse->nameservers = ['nameserver1','nameserver2'];

        $this->assertEquals($vanityDomainResponse, $this->mapper->toStdClass($this->mapper->fromStdClass($vanityDomainResponse, VanityDomainResponse::class)));
    }

    /** @test */
    public function toJson()
    {
        $expected = '{"id":1,"domain":"domain.com","hostedZoneId":"1A2B3C4D","status":1,"nameservers":["nameserver1","nameserver2"]}';

        $this->assertEquals($expected, $this->mapper->toJson($this->vanityDomainResponse));
    }

    /** @test */
    public function fromJson()
    {
        $vanityDomainResponse = '{"id":1,"domain":"domain.com","hostedZoneId":"1A2B3C4D","status":1,"nameservers":["nameserver1","nameserver2"]}';

        $this->assertEquals($this->vanityDomainResponse, $this->mapper->fromJson($vanityDomainResponse, VanityDomainResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_json()
    {
        $vanityDomainResponse = '{"id":1,"domain":"domain.com","hostedZoneId":"1A2B3C4D","status":1,"nameservers":["nameserver1","nameserver2"]}';

        $this->assertEquals($vanityDomainResponse, $this->mapper->toJson($this->mapper->fromJson($vanityDomainResponse, VanityDomainResponse::class)));
    }
}
