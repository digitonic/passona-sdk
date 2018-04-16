<?php

namespace Tests\Unit\Mappers\Requests;

use Digitonic\PassonaClient\Entities\ContactGroupRequest;
use Digitonic\PassonaClient\Mappers\Requests\ContactGroupRequestMapper;

/**
 * @property ContactGroupRequestMapper mapper
 * @property ContactGroupRequest contactGroupRequest
 */
class ContactGroupRequestMapperTest extends \PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        $this->contactGroupRequest = new ContactGroupRequest();
        $this->contactGroupRequest->setName('Contact Group Name');
        $this->contactGroupRequest->setDescription('Contact Group Description');

        $this->mapper = new ContactGroupRequestMapper();
    }

    /** @test */
    public function toArray()
    {
        $expected = [
            'name' => 'Contact Group Name',
            'description' => 'Contact Group Description'
        ];

        $this->assertEquals($expected, $this->mapper->toArray($this->contactGroupRequest));
    }

    /** @test */
    public function fromArray()
    {
        $contactGroupRequestArray = [
            'name' => 'Contact Group Name',
            'description' => 'Contact Group Description'
        ];

        $this->assertEquals($this->contactGroupRequest, $this->mapper->fromArray($contactGroupRequestArray, ContactGroupRequest::class));
    }

    /** @test */
    public function bidirectional_mapping_array()
    {
        $contactGroupRequestArray = [
            'name' => 'Contact Group Name',
            'description' => 'Contact Group Description'
        ];

        $this->assertEquals($contactGroupRequestArray, $this->mapper->toArray($this->mapper->fromArray($contactGroupRequestArray, ContactGroupRequest::class)));
    }

    /** @test */
    public function toStdClass()
    {
        $expected = new \stdClass();
        $expected->name = 'Contact Group Name';
        $expected->description = 'Contact Group Description';

        $this->assertEquals($expected, $this->mapper->toStdClass($this->contactGroupRequest));
    }

    /** @test */
    public function fromStdClass()
    {
        $contactGroupRequestStdClass = new \stdClass();
        $contactGroupRequestStdClass->name = 'Contact Group Name';
        $contactGroupRequestStdClass->description = 'Contact Group Description';

        $this->assertEquals($this->contactGroupRequest, $this->mapper->fromStdClass($contactGroupRequestStdClass, ContactGroupRequest::class));
    }

    /** @test */
    public function bidirectional_mapping_stdClass()
    {
        $contactGroupRequestStdClass = new \stdClass();
        $contactGroupRequestStdClass->name = 'Contact Group Name';
        $contactGroupRequestStdClass->description = 'Contact Group Description';

        $this->assertEquals($contactGroupRequestStdClass, $this->mapper->toStdClass($this->mapper->fromStdClass($contactGroupRequestStdClass, ContactGroupRequest::class)));
    }

    /** @test */
    public function toJson()
    {
        $expected = '{"name":"Contact Group Name","description":"Contact Group Description"}';

        $this->assertEquals($expected, $this->mapper->toJson($this->contactGroupRequest));
    }

    /** @test */
    public function fromJson()
    {
        $contactGroupRequestJson = '{"name":"Contact Group Name","description":"Contact Group Description"}';

        $this->assertEquals($this->contactGroupRequest, $this->mapper->fromJson($contactGroupRequestJson, ContactGroupRequest::class));
    }

    /** @test */
    public function bidirectional_mapping_json()
    {
        $contactGroupRequestJson = '{"name":"Contact Group Name","description":"Contact Group Description"}';

        $this->assertEquals($contactGroupRequestJson, $this->mapper->toJson($this->mapper->fromJson($contactGroupRequestJson, ContactGroupRequest::class)));
    }
}
