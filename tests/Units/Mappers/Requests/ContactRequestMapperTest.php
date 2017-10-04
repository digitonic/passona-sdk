<?php

namespace Tests\Unit\Mappers\Requests;

use Digitonic\PassonaClient\Entities\ContactRequest;
use Digitonic\PassonaClient\Mappers\Requests\ContactRequestMapper;

/**
 * @property ContactRequestMapper mapper
 * @property ContactRequest contactRequest
 */
class ContactRequestMapperTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->contactRequest = new ContactRequest();
        $this->contactRequest->setPhoneNumber('447123456789');
        $this->contactRequest->addCustomField('firstName', 'Yannick');
        $this->contactRequest->addCustomField('lastName', 'Glady');

        $this->mapper = new ContactRequestMapper();
    }

    /** @test */
    public function toArray()
    {
        $expected = [
            'phoneNumber' => '447123456789',
            'firstName' => 'Yannick',
            'lastName' => 'Glady'
        ];

        $this->assertEquals($expected, $this->mapper->toArray($this->contactRequest));
    }

    /** @test */
    public function fromArray()
    {
        $contactRequest = [
            'phoneNumber' => '447123456789',
            'firstName' => 'Yannick',
            'lastName' => 'Glady'
        ];

        $this->assertEquals($this->contactRequest, $this->mapper->fromArray($contactRequest));
    }

    /** @test */
    public function bidirectional_mapping_array()
    {
        $contactRequest = [
            'phoneNumber' => '447123456789',
            'firstName' => 'Yannick',
            'lastName' => 'Glady'
        ];

        $this->assertEquals($contactRequest, $this->mapper->toArray($this->mapper->fromArray($contactRequest, ContactRequest::class)));
    }

    /** @test */
    public function toStdClass()
    {
        $expected = new \stdClass();
        $expected->phoneNumber = '447123456789';
        $expected->firstName = 'Yannick';
        $expected->lastName = 'Glady';

        $this->assertEquals($expected, $this->mapper->toStdClass($this->contactRequest));
    }

    /** @test */
    public function fromStdClass()
    {
        $contactRequest = new \stdClass();
        $contactRequest->phoneNumber = '447123456789';
        $contactRequest->firstName = 'Yannick';
        $contactRequest->lastName = 'Glady';

        $this->assertEquals($this->contactRequest, $this->mapper->fromStdClass($contactRequest, ContactRequest::class));
    }

    /** @test */
    public function bidirectional_mapping_stdClass()
    {
        $contactRequest = new \stdClass();
        $contactRequest->phoneNumber = '447123456789';
        $contactRequest->firstName = 'Yannick';
        $contactRequest->lastName = 'Glady';

        $this->assertEquals($contactRequest, $this->mapper->toStdClass($this->mapper->fromStdClass($contactRequest, ContactRequest::class)));
    }

    /** @test */
    public function toJson()
    {
        $expected = '{"phoneNumber":"447123456789","firstName":"Yannick","lastName":"Glady"}';

        $this->assertEquals($expected, $this->mapper->toJson($this->contactRequest));
    }

    /** @test */
    public function fromJson()
    {
        $contactRequest = '{"phoneNumber":"447123456789","firstName":"Yannick","lastName":"Glady"}';

        $this->assertEquals($this->contactRequest, $this->mapper->fromJson($contactRequest));
    }

    /** @test */
    public function bidirectional_mapping_json()
    {
        $contactRequest = '{"phoneNumber":"447123456789","firstName":"Yannick","lastName":"Glady"}';

        $this->assertEquals($contactRequest, $this->mapper->toJson($this->mapper->fromJson($contactRequest, ContactRequest::class)));
    }
}
