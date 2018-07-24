<?php

namespace Tests\Unit\Mappers\Responses;

use Carbon\Carbon;
use Digitonic\PassonaClient\Entities\Responses\ContactGroupResponse;
use Digitonic\PassonaClient\Mappers\Responses\ContactGroupResponseMapper;
use PHPUnit\Framework\TestCase;

/**
 * @property ContactGroupResponseMapper mapper
 * @property \Digitonic\PassonaClient\Entities\Responses\ContactGroupResponse contactGroupResponse
 */
class ContactGroupResponseMapperTest extends TestCase
{
    public function setUp()
    {
        $this->mapper = new ContactGroupResponseMapper();

        $this->contactGroupResponse = new ContactGroupResponse();
        $this->contactGroupResponse->setId(1);
        $this->contactGroupResponse->setNumberOfContacts(2);
        $this->contactGroupResponse->setNumberOfUniqueProfiles(2);
        $this->contactGroupResponse->setFields(['firstname' => 'Yannick', 'lastname' => 'Glady']);
        $this->contactGroupResponse->setDescription('Contact Group Description');
        $this->contactGroupResponse->setName('Contact Group Name');
        $this->contactGroupResponse->setCreatedAt(Carbon::parse('2017-10-03T15:59:50+01:00'));
        $this->contactGroupResponse->setUpdatedAt(Carbon::parse('2017-10-03T16:00:19+01:00'));
    }

    /** @test */
    public function toArray()
    {
        $expected = [
            'id' => 1,
            'numberOfContacts' => 2,
            'numberOfUniqueProfiles' => 2,
            'fields' => [
                'firstname' => 'Yannick',
                'lastname' => 'Glady',
            ],
            'description' => 'Contact Group Description',
            'name' => 'Contact Group Name',
            'createdAt' => '2017-10-03T15:59:50+01:00',
            'updatedAt' => '2017-10-03T16:00:19+01:00'
        ];

        $this->assertEquals($expected, $this->mapper->toArray($this->contactGroupResponse));
    }

    /** @test */
    public function fromArray()
    {
        $contactGroupResponse = [
            'id' => 1,
            'numberOfContacts' => 2,
            'numberOfUniqueProfiles' => 2,
            'fields' => [
                'firstname' => 'Yannick',
                'lastname' => 'Glady',
            ],
            'description' => 'Contact Group Description',
            'name' => 'Contact Group Name',
            'createdAt' => '2017-10-03T15:59:50+01:00',
            'updatedAt' => '2017-10-03T16:00:19+01:00'
        ];

        $this->assertEquals($this->contactGroupResponse, $this->mapper->fromArray($contactGroupResponse, ContactGroupResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_array()
    {
        $contactGroupResponse = [
            'id' => 1,
            'numberOfContacts' => 2,
            'numberOfUniqueProfiles' => 2,
            'fields' => [
                'firstname' => 'Yannick',
                'lastname' => 'Glady',
            ],
            'description' => 'Contact Group Description',
            'name' => 'Contact Group Name',
            'createdAt' => '2017-10-03T15:59:50+01:00',
            'updatedAt' => '2017-10-03T16:00:19+01:00'
        ];

        $this->assertEquals($contactGroupResponse, $this->mapper->toArray($this->mapper->fromArray($contactGroupResponse, ContactGroupResponse::class)));
    }

    /** @test */
    public function toStdClass()
    {
        $expected = new \stdClass();
        $expected->id = 1;
        $expected->numberOfContacts = 2;
        $expected->numberOfUniqueProfiles = 2;
        $expected->fields = new \stdClass();
        $expected->fields->firstname = 'Yannick';
        $expected->fields->lastname = 'Glady';
        $expected->description = 'Contact Group Description';
        $expected->name = 'Contact Group Name';
        $expected->createdAt = '2017-10-03T15:59:50+01:00';
        $expected->updatedAt = '2017-10-03T16:00:19+01:00';

        $this->assertEquals($expected, $this->mapper->toStdClass($this->contactGroupResponse));
    }

    /** @test */
    public function fromStdClass()
    {
        $contactGroupResponse = new \stdClass();
        $contactGroupResponse->id = 1;
        $contactGroupResponse->numberOfContacts = 2;
        $contactGroupResponse->numberOfUniqueProfiles = 2;
        $contactGroupResponse->fields = new \stdClass();
        $contactGroupResponse->fields->firstname = 'Yannick';
        $contactGroupResponse->fields->lastname = 'Glady';
        $contactGroupResponse->description = 'Contact Group Description';
        $contactGroupResponse->name = 'Contact Group Name';
        $contactGroupResponse->createdAt = '2017-10-03T15:59:50+01:00';
        $contactGroupResponse->updatedAt = '2017-10-03T16:00:19+01:00';

        $this->assertEquals($this->contactGroupResponse, $this->mapper->fromStdClass($contactGroupResponse, ContactGroupResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_stdClass()
    {
        $contactGroupResponse = new \stdClass();
        $contactGroupResponse->id = 1;
        $contactGroupResponse->numberOfContacts = 2;
        $contactGroupResponse->numberOfUniqueProfiles = 2;
        $contactGroupResponse->fields = new \stdClass();
        $contactGroupResponse->fields->firstname = 'Yannick';
        $contactGroupResponse->fields->lastname = 'Glady';
        $contactGroupResponse->description = 'Contact Group Description';
        $contactGroupResponse->name = 'Contact Group Name';
        $contactGroupResponse->createdAt = '2017-10-03T15:59:50+01:00';
        $contactGroupResponse->updatedAt = '2017-10-03T16:00:19+01:00';

        $this->assertEquals($contactGroupResponse, $this->mapper->toStdClass($this->mapper->fromStdClass($contactGroupResponse, ContactGroupResponse::class)));
    }

    /** @test */
    public function toJson()
    {
        $expected = '{"id":1,"numberOfUniqueProfiles":2,"numberOfContacts":2,"description":"Contact Group Description","fields":{"firstname":"Yannick","lastname":"Glady"},"name":"Contact Group Name","updatedAt":"2017-10-03T16:00:19+01:00","createdAt":"2017-10-03T15:59:50+01:00"}';

        $this->assertEquals($expected, $this->mapper->toJson($this->contactGroupResponse));
    }

    /** @test */
    public function fromJson()
    {
        $contactGroupResponse = '{"id":1,"numberOfUniqueProfiles":2,"numberOfContacts":2,"description":"Contact Group Description","fields":{"firstname":"Yannick","lastname":"Glady"},"name":"Contact Group Name","updatedAt":"2017-10-03T16:00:19+01:00","createdAt":"2017-10-03T15:59:50+01:00"}';

        $this->assertEquals($this->contactGroupResponse, $this->mapper->fromJson($contactGroupResponse, ContactGroupResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_json()
    {
        $contactGroupResponse = '{"id":1,"numberOfUniqueProfiles":2,"numberOfContacts":2,"description":"Contact Group Description","fields":{"firstname":"Yannick","lastname":"Glady"},"name":"Contact Group Name","updatedAt":"2017-10-03T16:00:19+01:00","createdAt":"2017-10-03T15:59:50+01:00"}';

        $this->assertEquals($contactGroupResponse, $this->mapper->toJson($this->mapper->fromJson($contactGroupResponse, ContactGroupResponse::class)));
    }
}
