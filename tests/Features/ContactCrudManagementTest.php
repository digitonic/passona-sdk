<?php


namespace Tests\Feature;


use Carbon\Carbon;
use Digitonic\PassonaClient\Entities\Requests\ContactRequest;
use Digitonic\PassonaClient\Entities\Responses\ContactResponse;
use Digitonic\PassonaClient\Entities\Responses\ContactUploadResponse;
use Digitonic\PassonaClient\Entities\Responses\UploadedCsvFileResponse;

class ContactCrudManagementTest extends ClientTestCase
{
    /**
     * @var \Digitonic\PassonaClient\Entities\Requests\ContactRequest
     */
    private $contact1;
    /**
     * @var \Digitonic\PassonaClient\Entities\Requests\ContactRequest
     */
    private $contact2;
    /**
     * @var ContactUploadResponse
     */
    private $contactUpload;

    public function setUp()
    {
        parent::setUp();
        $this->contact1 = new ContactResponse();
        $this->contact1->setId(1);
        $this->contact1->setPhoneNumber("447123456789");
        $this->contact1->setUpdatedAt(Carbon::parse('2017-09-25 15:15:08'));
        $this->contact1->addCustomField('firstname', 'yannick');

        $this->contact2 = new ContactResponse();
        $this->contact2->setId(2);
        $this->contact2->setPhoneNumber("447987654321");
        $this->contact2->setUpdatedAt(Carbon::parse('2017-09-25 15:15:40'));

        $uploadedCsvFile = new UploadedCsvFileResponse();
        $uploadedCsvFile->setId(1);
        $uploadedCsvFile->setRows([['447123456789'],[],[],[],[]]);
        $uploadedCsvFile->setPossiblePhoneColumns([0]);
        $uploadedCsvFile->setOriginalFilename('my-hash.txt');
        $uploadedCsvFile->setNumRows(1);
        $uploadedCsvFile->setHeadings(['phoneNumber']);
        $uploadedCsvFile->setFilesize('25.00 B');
        $uploadedCsvFile->setColumnCount(1);
        $uploadedCsvFile->setFilename('my-hash.txt');

        $this->contactUpload = new ContactUploadResponse();
        $this->contactUpload->setId(1);
        $this->contactUpload->setUploadedCsvFile($uploadedCsvFile);
        $this->contactUpload->setPhoneNumberIndex(0);
        $this->contactUpload->setCreatedAt(Carbon::parse('2017-09-26 13:46:52'));
        $this->contactUpload->setStatus(ContactUploadResponse::STATUS_COMPLETE);
    }

    /** @test */
    public function getAllContacts()
    {
        $this->assertEquals([$this->contact1, $this->contact2], $this->client->getAllContactsInContactGroup(1));
    }

    /** @test */
    public function getContact()
    {
        $this->assertEquals($this->contact1, $this->client->getContactInContactGroup(1, 1));
    }

    /** @test */
    public function insertContact()
    {
        $request = new ContactRequest();
        $request->setPhoneNumber($this->contact1->getPhoneNumber());

        $this->assertEquals($this->contactUpload, $this->client->upsertContactsToContactGroup(1, [$request]));
    }

    /** @test */
    public function deleteContact()
    {
        $this->assertEquals(true, $this->client->deleteContactFromContactGroup(1, $this->contact1->getId()));
    }
}