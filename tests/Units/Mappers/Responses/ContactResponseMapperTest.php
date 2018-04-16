<?php

namespace Tests\Unit\Mappers\Responses;

use Carbon\Carbon;
use Digitonic\PassonaClient\Entities\ContactResponse;
use Digitonic\PassonaClient\Mappers\Responses\ContactResponseMapper;
use PHPUnit\Framework\TestCase;

/**
 * @property ContactResponseMapper mapper
 * @property ContactResponse contactResponse
 */
class ContactResponseMapperTest extends TestCase
{
    public function setUp()
    {
        $this->mapper = new ContactResponseMapper();
        $this->contactResponse = new ContactResponse();
        $this->contactResponse->setId(1);
        $this->contactResponse->setUpdatedAt(Carbon::parse('2017-10-03T15:44:02+01:00'));
        $this->contactResponse->setPhoneNumber('447123456789');
        $this->contactResponse->addCustomField('firstName', 'Yannick');
        $this->contactResponse->addCustomField('lastName', 'Glady');
    }

    /** @test */
    public function toArray()
    {
        $expected = [
            'id' => 1,
            'updatedAt' =>'2017-10-03T15:44:02+01:00',
            'phoneNumber' => 447123456789,
            'customFields' => [
                'firstName' => 'Yannick',
                'lastName' => 'Glady'
            ]
        ];

        $this->assertEquals($expected, $this->mapper->toArray($this->contactResponse));
    }

    /** @test */
    public function fromArray()
    {
        $contactResponse = [
            'id' => 1,
            'updatedAt' =>'2017-10-03T15:44:02+01:00',
            'phoneNumber' => 447123456789,
            'customFields' => [
                'firstName' => 'Yannick',
                'lastName' => 'Glady'
            ]
        ];

        $this->assertEquals($this->contactResponse, $this->mapper->fromArray($contactResponse, ContactResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_array()
    {
        $contactResponse = [
            'id' => 1,
            'updatedAt' =>'2017-10-03T15:44:02+01:00',
            'phoneNumber' => 447123456789,
            'customFields' => [
                'firstName' => 'Yannick',
                'lastName' => 'Glady'
            ]
        ];

        $this->assertEquals($contactResponse, $this->mapper->toArray($this->mapper->fromArray($contactResponse, ContactResponse::class)));
    }

    /** @test */
    public function toStdClass()
    {
        $expected = new \stdClass();
        $expected->id = 1;
        $expected->updatedAt = '2017-10-03T15:44:02+01:00';
        $expected->phoneNumber = '447123456789';
        $expected->customFields = new \stdClass();
        $expected->customFields->firstName = 'Yannick';
        $expected->customFields->lastName = 'Glady';

        $this->assertEquals($expected, $this->mapper->toStdClass($this->contactResponse));
    }

    /** @test */
    public function fromStdClass()
    {
        $contactResponse = new \stdClass();
        $contactResponse->id = 1;
        $contactResponse->updatedAt = '2017-10-03T15:44:02+01:00';
        $contactResponse->phoneNumber = '447123456789';
        $contactResponse->customFields = new \stdClass();
        $contactResponse->customFields->firstName = 'Yannick';
        $contactResponse->customFields->lastName = 'Glady';

        $this->assertEquals($this->contactResponse, $this->mapper->fromStdClass($contactResponse, ContactResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_stdClass()
    {
        $contactResponse = new \stdClass();
        $contactResponse->id = 1;
        $contactResponse->updatedAt = '2017-10-03T15:44:02+01:00';
        $contactResponse->phoneNumber = '447123456789';
        $contactResponse->customFields = new \stdClass();
        $contactResponse->customFields->firstName = 'Yannick';
        $contactResponse->customFields->lastName = 'Glady';

        $this->assertEquals($contactResponse, $this->mapper->toStdClass($this->mapper->fromStdClass($contactResponse, ContactResponse::class)));
    }

    /** @test */
    public function toJson()
    {
        $expected = '{"id":1,"phoneNumber":"447123456789","updatedAt":"2017-10-03T15:44:02+01:00","customFields":{"firstName":"Yannick","lastName":"Glady"}}';

        $this->assertEquals($expected, $this->mapper->toJson($this->contactResponse));
    }

    /** @test */
    public function fromJson()
    {
        $contactResponse = '{"id":1,"phoneNumber":"447123456789","updatedAt":"2017-10-03T15:44:02+01:00","customFields":{"firstName":"Yannick","lastName":"Glady"}}';

        $this->assertEquals($this->contactResponse, $this->mapper->fromJson($contactResponse, ContactResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_json()
    {
        $contactResponse = '{"id":1,"phoneNumber":"447123456789","updatedAt":"2017-10-03T15:44:02+01:00","customFields":{"firstName":"Yannick","lastName":"Glady"}}';

        $this->assertEquals($contactResponse, $this->mapper->toJson($this->mapper->fromJson($contactResponse, ContactResponse::class)));
    }
}
