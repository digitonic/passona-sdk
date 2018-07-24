<?php

namespace Tests\Unit\Mappers\Requests;

use Digitonic\PassonaClient\Entities\Requests\LinkRequest;
use Digitonic\PassonaClient\Entities\Requests\TemplateRequest;
use Digitonic\PassonaClient\Mappers\Requests\LinkRequestMapper;
use Digitonic\PassonaClient\Mappers\Requests\TemplateRequestMapper;
use PHPUnit\Framework\TestCase;

/**
 * @property TemplateRequestMapper mapper
 * @property \Digitonic\PassonaClient\Entities\Requests\TemplateRequest templateRequest
 */
class TemplateRequestMapperTest extends TestCase
{
    public function setUp()
    {
        $this->mapper = new TemplateRequestMapper(new LinkRequestMapper());

        $this->templateRequest = new TemplateRequest();
        $this->templateRequest->setName('Template Name');
        $this->templateRequest->setBody('Template Body');

        $linkRequest = new LinkRequest();
        $linkRequest->setName('Link Name');
        $linkRequest->setVanityDomainId(1);
        $linkRequest->setDestination('http://my.destination.com');

        $this->templateRequest->setLinks([$linkRequest]);
    }

    /** @test */
    public function toArray()
    {
        $expected = [
            'name' => 'Template Name',
            'body' => 'Template Body',
            'links' => [
                [
                    'name' => 'Link Name',
                    'vanityDomainId' => 1,
                    'destination' => 'http://my.destination.com'
                ]
            ]
        ];

        $this->assertEquals($expected, $this->mapper->toArray($this->templateRequest));
    }

    /** @test */
    public function fromArray()
    {
        $templateRequest = [
            'name' => 'Template Name',
            'body' => 'Template Body',
            'links' => [
                [
                    'name' => 'Link Name',
                    'vanityDomainId' => 1,
                    'destination' => 'http://my.destination.com'
                ]
            ]
        ];

        $this->assertEquals($this->templateRequest, $this->mapper->fromArray($templateRequest, TemplateRequest::class));
    }

    /** @test */
    public function bidirectional_mapping_array()
    {
        $templateRequest = [
            'name' => 'Template Name',
            'body' => 'Template Body',
            'links' => [
                [
                    'name' => 'Link Name',
                    'vanityDomainId' => 1,
                    'destination' => 'http://my.destination.com'
                ]
            ]
        ];

        $this->assertEquals($templateRequest, $this->mapper->toArray($this->mapper->fromArray($templateRequest, TemplateRequest::class)));
    }

    /** @test */
    public function toStdClass()
    {
        $expected = new \stdClass();
        $expected->name = 'Template Name';
        $expected->body = 'Template Body';
        $expectedLinkRequest = new \stdClass();
        $expectedLinkRequest->name = 'Link Name';
        $expectedLinkRequest->vanityDomainId = 1;
        $expectedLinkRequest->destination = 'http://my.destination.com';
        $expected->links = [$expectedLinkRequest];

        $this->assertEquals($expected, $this->mapper->toStdClass($this->templateRequest));
    }

    /** @test */
    public function fromStdClass()
    {
        $templateRequest = new \stdClass();
        $templateRequest->name = 'Template Name';
        $templateRequest->body = 'Template Body';
        $linkRequest = new \stdClass();
        $linkRequest->name = 'Link Name';
        $linkRequest->vanityDomainId = 1;
        $linkRequest->destination = 'http://my.destination.com';
        $templateRequest->links = [$linkRequest];

        $this->assertEquals($this->templateRequest, $this->mapper->fromStdClass($templateRequest, TemplateRequest::class));
    }

    /** @test */
    public function bidrectional_mapping_stdClass()
    {
        $templateRequest = new \stdClass();
        $templateRequest->name = 'Template Name';
        $templateRequest->body = 'Template Body';
        $linkRequest = new \stdClass();
        $linkRequest->name = 'Link Name';
        $linkRequest->vanityDomainId = 1;
        $linkRequest->destination = 'http://my.destination.com';
        $templateRequest->links = [$linkRequest];

        $this->assertEquals($templateRequest, $this->mapper->toStdClass($this->mapper->fromStdClass($templateRequest, TemplateRequest::class)));
    }

    /** @test */
    public function toJson()
    {
        $expected = '{"name":"Template Name","body":"Template Body","links":[{"name":"Link Name","destination":"http:\/\/my.destination.com","vanityDomainId":1}]}';

        $this->assertEquals($expected, $this->mapper->toJson($this->templateRequest));
    }

    /** @test */
    public function fromJson()
    {
        $templateRequest = $expected = '{"name":"Template Name","body":"Template Body","links":[{"name":"Link Name","destination":"http:\/\/my.destination.com","vanityDomainId":1}]}';

        $this->assertEquals($this->templateRequest, $this->mapper->fromJson($templateRequest, TemplateRequest::class));
    }

    /** @test */
    public function bidirectional_mapping_json()
    {
        $templateRequest = $expected = '{"name":"Template Name","body":"Template Body","links":[{"name":"Link Name","destination":"http:\/\/my.destination.com","vanityDomainId":1}]}';

        $this->assertEquals($templateRequest, $this->mapper->toJson($this->mapper->fromJson($templateRequest, TemplateRequest::class)));
    }
}
