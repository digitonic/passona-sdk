<?php

namespace Tests\Unit\Mappers\Requests;

use Digitonic\PassonaClient\Entities\LinkRequest;
use Digitonic\PassonaClient\Mappers\Requests\LinkRequestMapper;
use PHPUnit\Framework\TestCase;

/**
 * @property LinkRequestMapper mapper
 * @property LinkRequest linkRequest
 */
class LinkRequestMapperTest extends TestCase
{
    public function setUp()
    {
        $this->linkRequest = new LinkRequest();
        $this->linkRequest->setName('Link Name');
        $this->linkRequest->setDestination('http://my.destination.com');
        $this->linkRequest->setVanityDomainId(1);

        $this->mapper = new LinkRequestMapper();
    }

    /** @test */
    public function toArray()
    {
        $expected = [
            'name' => 'Link Name',
            'destination' => 'http://my.destination.com',
            'vanityDomainId' => 1
        ];

        $this->assertEquals($expected, $this->mapper->toArray($this->linkRequest));
    }

    /** @test */
    public function fromArray()
    {
        $linkRequest = [
            'name' => 'Link Name',
            'destination' => 'http://my.destination.com',
            'vanityDomainId' => 1
        ];

        $this->assertEquals($this->linkRequest, $this->mapper->fromArray($linkRequest, LinkRequest::class));
    }

    /** @test */
    public function bidirectional_mapping_array()
    {
        $linkRequest = [
            'name' => 'Link Name',
            'destination' => 'http://my.destination.com',
            'vanityDomainId' => 1
        ];

        $this->assertEquals($linkRequest, $this->mapper->toArray($this->mapper->fromArray($linkRequest, LinkRequest::class)));
    }

    /** @test */
    public function toStdClass()
    {
        $expected = new \stdClass();
        $expected->name = 'Link Name';
        $expected->destination = 'http://my.destination.com';
        $expected->vanityDomainId = 1;

        $this->assertEquals($expected, $this->mapper->toStdClass($this->linkRequest));
    }

    /** @test */
    public function fromStdClass()
    {
        $linkRequest = new \stdClass();
        $linkRequest->name = 'Link Name';
        $linkRequest->destination = 'http://my.destination.com';
        $linkRequest->vanityDomainId = 1;

        $this->assertEquals($this->linkRequest, $this->mapper->fromStdClass($linkRequest, LinkRequest::class));
    }

    /** @test */
    public function bidirectional_mapping_stdClass()
    {
        $linkRequest = new \stdClass();
        $linkRequest->name = 'Link Name';
        $linkRequest->destination = 'http://my.destination.com';
        $linkRequest->vanityDomainId = 1;

        $this->assertEquals($linkRequest, $this->mapper->toStdClass($this->mapper->fromStdClass($linkRequest, LinkRequest::class)));
    }

    /** @test */
    public function toJson()
    {
        $expected = '{"name":"Link Name","destination":"http:\/\/my.destination.com","vanityDomainId":1}';

        $this->assertEquals($expected, $this->mapper->toJson($this->linkRequest));
    }

    /** @test */
    public function fromJson()
    {
        $linkRequest = '{"name":"Link Name","destination":"http:\/\/my.destination.com","vanityDomainId":1}';

        $this->assertEquals($this->linkRequest, $this->mapper->fromJson($linkRequest, LinkRequest::class));
    }

    /** @test */
    public function bidirectional_mapping_Json()
    {
        $linkRequest = '{"name":"Link Name","destination":"http:\/\/my.destination.com","vanityDomainId":1}';

        $this->assertEquals($linkRequest, $this->mapper->toJson($this->mapper->fromJson($linkRequest, LinkRequest::class)));
    }
}
