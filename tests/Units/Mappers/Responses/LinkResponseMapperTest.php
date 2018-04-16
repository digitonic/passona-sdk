<?php

namespace Tests\Unit\Mappers\Responses;

use Digitonic\PassonaClient\Entities\LinkResponse;
use Digitonic\PassonaClient\Entities\VanityDomainResponse;
use Digitonic\PassonaClient\Mappers\Responses\LinkResponseMapper;
use Digitonic\PassonaClient\Mappers\Responses\VanityDomainResponseMapper;
use PHPUnit\Framework\TestCase;

/**
 * @property LinkResponseMapper mapper
 * @property LinkResponse linkResponse
 * @property VanityDomainResponse vanityDomainResponse
 */
class LinkResponseMapperTest extends TestCase
{
    public function setUp()
    {
        $this->mapper = new LinkResponseMapper(new VanityDomainResponseMapper());

        $this->vanityDomainResponse = new VanityDomainResponse();
        $this->vanityDomainResponse->setId(1);
        $this->vanityDomainResponse->setNameservers(['nameserver1', 'nameserver2']);
        $this->vanityDomainResponse->setDomain('domain.com');
        $this->vanityDomainResponse->setHostedZoneId('1A2B3C4D');
        $this->vanityDomainResponse->setStatus(1);

        $this->linkResponse = new LinkResponse();
        $this->linkResponse->setName('Link Name');
        $this->linkResponse->setDestination('http://my.destination.com');
        $this->linkResponse->setId(1);
        $this->linkResponse->setVanityDomainId($this->vanityDomainResponse->getId());
        $this->linkResponse->setVanityDomainDomain($this->vanityDomainResponse->getDomain());
        $this->linkResponse->setDeleted(false);
        $this->linkResponse->setVanityDomain($this->vanityDomainResponse);
    }

    /** @test */
    public function toArray()
    {
        $expected = [
            'name' => $this->linkResponse->getName(),
            'destination' => $this->linkResponse->getDestination(),
            'id' => $this->linkResponse->getId(),
            'deleted' => $this->linkResponse->isDeleted(),
            'vanityDomainDomain' => $this->linkResponse->getVanityDomainDomain(),
            'vanityDomain' => [
                'data' => [
                    'id' => $this->vanityDomainResponse->getId(),
                    'nameservers' => $this->vanityDomainResponse->getNameservers(),
                    'domain' => $this->vanityDomainResponse->getDomain(),
                    'hostedZoneId' => $this->vanityDomainResponse->getHostedZoneId(),
                    'status' => $this->vanityDomainResponse->getStatus()
                ]
            ],
            'vanityDomainId' => $this->linkResponse->getVanityDomainId(),
        ];

        $this->assertEquals($expected, $this->mapper->toArray($this->linkResponse));
    }

    /** @test */
    public function fromArray()
    {
        $linkResponse = [
            'name' => $this->linkResponse->getName(),
            'destination' => $this->linkResponse->getDestination(),
            'id' => $this->linkResponse->getId(),
            'deleted' => $this->linkResponse->isDeleted(),
            'vanityDomainDomain' => $this->linkResponse->getVanityDomainDomain(),
            'vanityDomain' => [
                'data' => [
                    'id' => $this->vanityDomainResponse->getId(),
                    'nameservers' => $this->vanityDomainResponse->getNameservers(),
                    'domain' => $this->vanityDomainResponse->getDomain(),
                    'hostedZoneId' => $this->vanityDomainResponse->getHostedZoneId(),
                    'status' => $this->vanityDomainResponse->getStatus()
                ]
            ],
            'vanityDomainId' => $this->linkResponse->getVanityDomainId(),
        ];

        $this->assertEquals($this->linkResponse, $this->mapper->fromArray($linkResponse, LinkResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_array()
    {
        $linkResponse = [
            'name' => $this->linkResponse->getName(),
            'destination' => $this->linkResponse->getDestination(),
            'id' => $this->linkResponse->getId(),
            'deleted' => $this->linkResponse->isDeleted(),
            'vanityDomainDomain' => $this->linkResponse->getVanityDomainDomain(),
            'vanityDomain' => [
                'data' => [
                    'id' => $this->vanityDomainResponse->getId(),
                    'nameservers' => $this->vanityDomainResponse->getNameservers(),
                    'domain' => $this->vanityDomainResponse->getDomain(),
                    'hostedZoneId' => $this->vanityDomainResponse->getHostedZoneId(),
                    'status' => $this->vanityDomainResponse->getStatus()
                ]
            ],
            'vanityDomainId' => $this->linkResponse->getVanityDomainId(),
        ];

        $this->assertEquals($linkResponse, $this->mapper->toArray($this->mapper->fromArray($linkResponse, LinkResponse::class)));
    }

    /** @test */
    public function toStdClass()
    {
        $expected = new \stdClass();
        $expected->name = $this->linkResponse->getName();
        $expected->destination = $this->linkResponse->getDestination();
        $expected->id = $this->linkResponse->getId();
        $expected->deleted = $this->linkResponse->isDeleted();
        $expected->vanityDomainDomain = $this->linkResponse->getVanityDomainDomain();

        $vanityDomainStdClass = new \stdClass();
        $vanityDomainStdClass->id = $this->vanityDomainResponse->getId();
        $vanityDomainStdClass->nameservers = $this->vanityDomainResponse->getNameservers();
        $vanityDomainStdClass->domain = $this->vanityDomainResponse->getDomain();
        $vanityDomainStdClass->hostedZoneId = $this->vanityDomainResponse->getHostedZoneId();
        $vanityDomainStdClass->status = $this->vanityDomainResponse->getStatus();

        $expected->vanityDomain = new \stdClass();
        $expected->vanityDomain->data = $vanityDomainStdClass;
        $expected->vanityDomainId = $this->linkResponse->getVanityDomainId();

        $this->assertEquals($expected, $this->mapper->toStdClass($this->linkResponse));
    }

    /** @test */
    public function fromStdClass()
    {
        $linkResponse = new \stdClass();
        $linkResponse->name = $this->linkResponse->getName();
        $linkResponse->destination = $this->linkResponse->getDestination();
        $linkResponse->id = $this->linkResponse->getId();
        $linkResponse->deleted = $this->linkResponse->isDeleted();
        $linkResponse->vanityDomainDomain = $this->linkResponse->getVanityDomainDomain();

        $vanityDomainStdClass = new \stdClass();
        $vanityDomainStdClass->id = $this->vanityDomainResponse->getId();
        $vanityDomainStdClass->nameservers = $this->vanityDomainResponse->getNameservers();
        $vanityDomainStdClass->domain = $this->vanityDomainResponse->getDomain();
        $vanityDomainStdClass->hostedZoneId = $this->vanityDomainResponse->getHostedZoneId();
        $vanityDomainStdClass->status = $this->vanityDomainResponse->getStatus();

        $linkResponse->vanityDomain = new \stdClass();
        $linkResponse->vanityDomain->data = $vanityDomainStdClass;
        $linkResponse->vanityDomainId = $this->linkResponse->getVanityDomainId();

        $this->assertEquals($this->linkResponse, $this->mapper->fromStdClass($linkResponse, LinkResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_stdClass()
    {
        $linkResponse = new \stdClass();
        $linkResponse->name = $this->linkResponse->getName();
        $linkResponse->destination = $this->linkResponse->getDestination();
        $linkResponse->id = $this->linkResponse->getId();
        $linkResponse->deleted = $this->linkResponse->isDeleted();
        $linkResponse->vanityDomainDomain = $this->linkResponse->getVanityDomainDomain();

        $vanityDomainStdClass = new \stdClass();
        $vanityDomainStdClass->id = $this->vanityDomainResponse->getId();
        $vanityDomainStdClass->nameservers = $this->vanityDomainResponse->getNameservers();
        $vanityDomainStdClass->domain = $this->vanityDomainResponse->getDomain();
        $vanityDomainStdClass->hostedZoneId = $this->vanityDomainResponse->getHostedZoneId();
        $vanityDomainStdClass->status = $this->vanityDomainResponse->getStatus();

        $linkResponse->vanityDomain = new \stdClass();
        $linkResponse->vanityDomain->data = $vanityDomainStdClass;
        $linkResponse->vanityDomainId = $this->linkResponse->getVanityDomainId();

        $this->assertEquals($linkResponse, $this->mapper->toStdClass($this->mapper->fromStdClass($linkResponse, LinkResponse::class)));
    }

    /** @test */
    public function toJson()
    {
        $expected = '{"id":1,"name":"Link Name","destination":"http:\/\/my.destination.com","deleted":false,"vanityDomain":{"data":{"id":1,"domain":"domain.com","hostedZoneId":"1A2B3C4D","status":1,"nameservers":["nameserver1","nameserver2"]}},"vanityDomainDomain":"domain.com","vanityDomainId":1}';

        $this->assertEquals($expected, $this->mapper->toJson($this->linkResponse));
    }

    /** @test */
    public function fromJson()
    {
        $linkResponse = '{"id":1,"name":"Link Name","destination":"http:\/\/my.destination.com","deleted":false,"vanityDomain":{"data":{"id":1,"domain":"domain.com","hostedZoneId":"1A2B3C4D","status":1,"nameservers":["nameserver1","nameserver2"]}},"vanityDomainDomain":"domain.com","vanityDomainId":1}';

        $this->assertEquals($this->linkResponse, $this->mapper->fromJson($linkResponse, LinkResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_json()
    {
        $linkResponse = '{"id":1,"name":"Link Name","destination":"http:\/\/my.destination.com","deleted":false,"vanityDomain":{"data":{"id":1,"domain":"domain.com","hostedZoneId":"1A2B3C4D","status":1,"nameservers":["nameserver1","nameserver2"]}},"vanityDomainDomain":"domain.com","vanityDomainId":1}';

        $this->assertEquals($linkResponse, $this->mapper->toJson($this->mapper->fromJson($linkResponse, LinkResponse::class)));
    }
}
