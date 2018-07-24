<?php


namespace Tests\Feature;


use Carbon\Carbon;
use Digitonic\PassonaClient\Entities\Requests\ContactGroupRequest;
use Digitonic\PassonaClient\Entities\Responses\ContactGroupResponse;

class ContactGroupCrudManagementTest extends ClientTestCase
{
    /**
     * @var ContactGroupRequest
     */
    private $contactGroup1;
    /**
     * @var ContactGroupRequest
     */
    private $contactGroup2;

    public function setUp()
    {
        parent::setUp();
        $this->contactGroup1 = new ContactGroupResponse();
        $this->contactGroup1->setId(1);
        $this->contactGroup1->setCreatedAt(Carbon::parse('2017-09-26 14:43:52', 'Europe/London'));
        $this->contactGroup1->setUpdatedAt(Carbon::parse('2017-09-26 14:44:15', 'Europe/London'));
        $this->contactGroup1->setName('my group 1');
        $this->contactGroup1->setDescription('Description for my group 1');
        $this->contactGroup1->setFields(['firstName', 'lastName']);
        $this->contactGroup1->setNumberOfContacts(1);
        $this->contactGroup1->setNumberOfUniqueProfiles(1);

        $this->contactGroup2 = new ContactGroupResponse();
        $this->contactGroup2->setId(2);
        $this->contactGroup2->setCreatedAt(Carbon::parse('2017-09-26 14:43:52', 'Europe/London'));
        $this->contactGroup2->setUpdatedAt(Carbon::parse('2017-09-26 14:44:15', 'Europe/London'));
        $this->contactGroup2->setName('my group 2');
        $this->contactGroup2->setDescription('Description for my group 2');
        $this->contactGroup2->setFields(['firstName', 'lastName']);
        $this->contactGroup2->setNumberOfContacts(1);
        $this->contactGroup2->setNumberOfUniqueProfiles(1);
    }

    /** @test */
    public function getAllContactGroups()
    {
        $this->assertEquals([$this->contactGroup1, $this->contactGroup2], $this->client->getAllContactGroups());
    }

    /** @test */
    public function postContactGroup()
    {
        $contactGroupRequest = new ContactGroupRequest();
        $contactGroupRequest->setName($this->contactGroup1->getName());
        $contactGroupRequest->setDescription($this->contactGroup1->getDescription());

        $this->assertEquals($this->contactGroup1, $this->client->postContactGroup($contactGroupRequest));
    }

    /** @test */
    public function putContactGroup()
    {
        $this->contactGroup1->setName('Updated name');

        $contactGroupRequest = new ContactGroupRequest();
        $contactGroupRequest->setName($this->contactGroup1->getName());
        $contactGroupRequest->setDescription($this->contactGroup1->getDescription());

        $this->assertEquals($this->contactGroup1, $this->client->putContactGroup(1, $contactGroupRequest));
    }

    /** @test */
    public function deleteContactGroup()
    {
        $this->assertTrue($this->client->deleteContactGroup($this->contactGroup1->getId()));
    }
}