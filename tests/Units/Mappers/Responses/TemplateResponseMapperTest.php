<?php

namespace Tests\Unit\Mappers\Responses;

use Digitonic\PassonaClient\Entities\Responses\LinkResponse;
use Digitonic\PassonaClient\Entities\Responses\TemplateResponse;
use Digitonic\PassonaClient\Entities\Responses\VanityDomainResponse;
use Digitonic\PassonaClient\Mappers\Responses\LinkResponseMapper;
use Digitonic\PassonaClient\Mappers\Responses\TemplateResponseMapper;
use Digitonic\PassonaClient\Mappers\Responses\VanityDomainResponseMapper;
use PHPUnit\Framework\TestCase;

/**
 * @property TemplateResponseMapper mapper
 * @property TemplateResponse templateResponse
 */
class TemplateResponseMapperTest extends TestCase
{
    public function setUp()
    {
        $this->mapper = new TemplateResponseMapper(new LinkResponseMapper(new VanityDomainResponseMapper()));

        $vanityDomainResponse = new VanityDomainResponse();
        $vanityDomainResponse->setId(1);
        $vanityDomainResponse->setNameservers(['nameserver1', 'nameserver2']);
        $vanityDomainResponse->setDomain('domain.com');
        $vanityDomainResponse->setHostedZoneId('1A2B3C4D');
        $vanityDomainResponse->setStatus(1);

        $linkResponse = new LinkResponse();
        $linkResponse->setName('Link Name');
        $linkResponse->setDestination('http://my.destination.com');
        $linkResponse->setId(1);
        $linkResponse->setVanityDomainId($vanityDomainResponse->getId());
        $linkResponse->setVanityDomainDomain($vanityDomainResponse->getDomain());
        $linkResponse->setDeleted(false);
        $linkResponse->setVanityDomain($vanityDomainResponse);

        $this->templateResponse = new TemplateResponse();
        $this->templateResponse->setName('Template Name');
        $this->templateResponse->setBody('Template Body');
        $this->templateResponse->setId(1);
        $this->templateResponse->setLinks([$linkResponse]);
    }

    /** @test */
    public function toArray()
    {
        $expected = [
            'name' => 'Template Name',
            'id' => 1,
            'body' => 'Template Body',
            'links' => [
                'data' => [[
                    'name' => 'Link Name',
                    'destination' => 'http://my.destination.com',
                    'id' => 1,
                    'deleted' => false,
                    'vanityDomainDomain' => 'domain.com',
                    'vanityDomain' => [
                        'data' => [
                            'id' => 1,
                            'nameservers' => ['nameserver1', 'nameserver2'],
                            'domain' => 'domain.com',
                            'hostedZoneId' => '1A2B3C4D',
                            'status' => 1
                        ]
                    ],
                    'vanityDomainId' => 1,
                ]]
            ]
        ];

        $this->assertEquals($expected, $this->mapper->toArray($this->templateResponse));
    }

    /** @test */
    public function fromArray()
    {
        $templateResponse = [
            'name' => 'Template Name',
            'id' => 1,
            'body' => 'Template Body',
            'links' => [
                'data' => [[
                    'name' => 'Link Name',
                    'destination' => 'http://my.destination.com',
                    'id' => 1,
                    'deleted' => false,
                    'vanityDomainDomain' => 'domain.com',
                    'vanityDomain' => [
                        'data' => [
                            'id' => 1,
                            'nameservers' => ['nameserver1', 'nameserver2'],
                            'domain' => 'domain.com',
                            'hostedZoneId' => '1A2B3C4D',
                            'status' => 1
                        ]
                    ],
                    'vanityDomainId' => 1,
                ]]
            ]
        ];

        $this->assertEquals($this->templateResponse, $this->mapper->fromArray($templateResponse, TemplateResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_array()
    {
        $templateResponse = [
            'name' => 'Template Name',
            'id' => 1,
            'body' => 'Template Body',
            'links' => [
                'data' => [[
                    'name' => 'Link Name',
                    'destination' => 'http://my.destination.com',
                    'id' => 1,
                    'deleted' => false,
                    'vanityDomainDomain' => 'domain.com',
                    'vanityDomain' => [
                        'data' => [
                            'id' => 1,
                            'nameservers' => ['nameserver1', 'nameserver2'],
                            'domain' => 'domain.com',
                            'hostedZoneId' => '1A2B3C4D',
                            'status' => 1
                        ]
                    ],
                    'vanityDomainId' => 1,
                ]]
            ]
        ];

        $this->assertEquals($templateResponse, $this->mapper->toArray($this->mapper->fromArray($templateResponse, TemplateResponse::class)));
    }

    /** @test */
    public function toStdClass()
    {
        $expectedVanityDomain = new \stdClass();
        $expectedVanityDomain->id = 1;
        $expectedVanityDomain->nameservers = ['nameserver1','nameserver2'];
        $expectedVanityDomain->domain = 'domain.com';
        $expectedVanityDomain->hostedZoneId = '1A2B3C4D';
        $expectedVanityDomain->status = 1;

        $expectedLink = new \stdClass();
        $expectedLink->name = 'Link Name';
        $expectedLink->destination = 'http://my.destination.com';
        $expectedLink->id = 1;
        $expectedLink->deleted = false;
        $expectedLink->vanityDomainDomain = 'domain.com';
        $expectedLink->vanityDomain = new \stdClass();
        $expectedLink->vanityDomain->data = $expectedVanityDomain;
        $expectedLink->vanityDomainId = 1;

        $expected = new \stdClass();
        $expected->name = 'Template Name';
        $expected->id = 1;
        $expected->body = 'Template Body';
        $expected->links = new \stdClass();
        $expected->links->data = [$expectedLink];

        $this->assertEquals($expected, $this->mapper->toStdClass($this->templateResponse));

    }

    /** @test */
    public function fromStdClass()
    {
        $vanityDomainResponse = new \stdClass();
        $vanityDomainResponse->id = 1;
        $vanityDomainResponse->nameservers = ['nameserver1','nameserver2'];
        $vanityDomainResponse->domain = 'domain.com';
        $vanityDomainResponse->hostedZoneId = '1A2B3C4D';
        $vanityDomainResponse->status = 1;

        $linkResponse = new \stdClass();
        $linkResponse->name = 'Link Name';
        $linkResponse->destination = 'http://my.destination.com';
        $linkResponse->id = 1;
        $linkResponse->deleted = false;
        $linkResponse->vanityDomainDomain = 'domain.com';
        $linkResponse->vanityDomain = new \stdClass();
        $linkResponse->vanityDomain->data = $vanityDomainResponse;
        $linkResponse->vanityDomainId = 1;

        $templateResponse = new \stdClass();
        $templateResponse->name = 'Template Name';
        $templateResponse->id = 1;
        $templateResponse->body = 'Template Body';
        $templateResponse->links = new \stdClass();
        $templateResponse->links->data = [$linkResponse];

        $this->assertEquals($this->templateResponse, $this->mapper->fromStdClass($templateResponse, TemplateResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_stdClass()
    {
        $vanityDomainResponse = new \stdClass();
        $vanityDomainResponse->id = 1;
        $vanityDomainResponse->nameservers = ['nameserver1','nameserver2'];
        $vanityDomainResponse->domain = 'domain.com';
        $vanityDomainResponse->hostedZoneId = '1A2B3C4D';
        $vanityDomainResponse->status = 1;

        $linkResponse = new \stdClass();
        $linkResponse->name = 'Link Name';
        $linkResponse->destination = 'http://my.destination.com';
        $linkResponse->id = 1;
        $linkResponse->deleted = false;
        $linkResponse->vanityDomainDomain = 'domain.com';
        $linkResponse->vanityDomain = new \stdClass();
        $linkResponse->vanityDomain->data = $vanityDomainResponse;
        $linkResponse->vanityDomainId = 1;

        $templateResponse = new \stdClass();
        $templateResponse->name = 'Template Name';
        $templateResponse->id = 1;
        $templateResponse->body = 'Template Body';
        $templateResponse->links = new \stdClass();
        $templateResponse->links->data = [$linkResponse];

        $this->assertEquals($templateResponse, $this->mapper->toStdClass($this->mapper->fromStdClass($templateResponse, TemplateResponse::class)));
    }

    /** @test */
    public function toJson()
    {
        $expected = '{"id":1,"name":"Template Name","body":"Template Body","links":{"data":[{"id":1,"name":"Link Name","destination":"http:\/\/my.destination.com","deleted":false,"vanityDomain":{"data":{"id":1,"domain":"domain.com","hostedZoneId":"1A2B3C4D","status":1,"nameservers":["nameserver1","nameserver2"]}},"vanityDomainDomain":"domain.com","vanityDomainId":1}]}}';

        $this->assertEquals($expected, $this->mapper->toJson($this->templateResponse));
    }

    /** @test */
    public function fromJson()
    {
        $templateResponse = '{"id":1,"name":"Template Name","body":"Template Body","links":{"data":[{"id":1,"name":"Link Name","destination":"http:\/\/my.destination.com","deleted":false,"vanityDomain":{"data":{"id":1,"domain":"domain.com","hostedZoneId":"1A2B3C4D","status":1,"nameservers":["nameserver1","nameserver2"]}},"vanityDomainDomain":"domain.com","vanityDomainId":1}]}}';

        $this->assertEquals($this->templateResponse, $this->mapper->fromJson($templateResponse, TemplateResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_json()
    {
        $templateResponse = '{"id":1,"name":"Template Name","body":"Template Body","links":{"data":[{"id":1,"name":"Link Name","destination":"http:\/\/my.destination.com","deleted":false,"vanityDomain":{"data":{"id":1,"domain":"domain.com","hostedZoneId":"1A2B3C4D","status":1,"nameservers":["nameserver1","nameserver2"]}},"vanityDomainDomain":"domain.com","vanityDomainId":1}]}}';

        $this->assertEquals($templateResponse, $this->mapper->toJson($this->mapper->fromJson($templateResponse, TemplateResponse::class)));
    }

}
