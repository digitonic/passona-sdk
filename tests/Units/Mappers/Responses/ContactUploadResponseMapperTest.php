<?php

namespace Tests\Unit\Mappers\Responses;

use Carbon\Carbon;
use Digitonic\PassonaClient\Entities\Responses\ContactUploadResponse;
use Digitonic\PassonaClient\Entities\Responses\UploadedCsvFileResponse;
use Digitonic\PassonaClient\Mappers\Responses\ContactUploadResponseMapper;
use Digitonic\PassonaClient\Mappers\Responses\UploadedCsvFileResponseMapper;
use PHPUnit\Framework\TestCase;

/**
 * @property ContactUploadResponseMapper mapper
 * @property ContactUploadResponse contactUploadResponse
 */
class ContactUploadResponseMapperTest extends TestCase
{
    public function setUp()
    {
        $this->mapper = new ContactUploadResponseMapper(new UploadedCsvFileResponseMapper());

        $uploadedCsvFileResponse = new UploadedCsvFileResponse();
        $uploadedCsvFileResponse->setId(1);
        $uploadedCsvFileResponse->setRows([['447123456789']]);
        $uploadedCsvFileResponse->setPossiblePhoneColumns([0]);
        $uploadedCsvFileResponse->setOriginalFilename('my-clients.txt');
        $uploadedCsvFileResponse->setNumRows(1);
        $uploadedCsvFileResponse->setHeadings(['phoneNumber']);
        $uploadedCsvFileResponse->setFilesize('10.00 B');
        $uploadedCsvFileResponse->setColumnCount(1);
        $uploadedCsvFileResponse->setFilename('my-clients.txt');

        $this->contactUploadResponse = new ContactUploadResponse();
        $this->contactUploadResponse->setId(1);
        $this->contactUploadResponse->setStatus(1);
        $this->contactUploadResponse->setUploadedCsvFile($uploadedCsvFileResponse);
        $this->contactUploadResponse->setPhoneNumberIndex(0);
        $this->contactUploadResponse->setCreatedAt(Carbon::parse('2017-10-03T15:12:52+01:00'));
    }

    /** @test */
    public function toArray()
    {
        $expected = [
            'id' => 1,
            'status' => 1,
            'phoneNumberIndex' => 0,
            'createdAt' => [
                'date' => '2017-10-03T15:12:52+01:00'
            ],
            'uploadedCsvFile' => [
                'data' => [
                    'id' => 1,
                    'rows' => [['447123456789']],
                    'possiblePhoneColumns' => [0],
                    'originalFilename' => 'my-clients.txt',
                    'numRows' => 1,
                    'headings' => ['phoneNumber'],
                    'filesize' => '10.00 B',
                    'columnCount' => 1,
                    'filename' => 'my-clients.txt'
                ]
            ]
        ];

        $this->assertEquals($expected, $this->mapper->toArray($this->contactUploadResponse));
    }

    /** @test */
    public function fromArray()
    {
        $contactUploadResponse = [
            'id' => 1,
            'status' => 1,
            'phoneNumberIndex' => 0,
            'createdAt' => [
                'date' => '2017-10-03T15:12:52+01:00'
            ],
            'uploadedCsvFile' => [
                'data' => [
                    'id' => 1,
                    'rows' => [['447123456789']],
                    'possiblePhoneColumns' => [0],
                    'originalFilename' => 'my-clients.txt',
                    'numRows' => 1,
                    'headings' => ['phoneNumber'],
                    'filesize' => '10.00 B',
                    'columnCount' => 1,
                    'filename' => 'my-clients.txt'
                ]
            ]
        ];

        $this->assertEquals($this->contactUploadResponse, $this->mapper->fromArray($contactUploadResponse, ContactUploadResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_array()
    {
        $contactUploadResponse = [
            'id' => 1,
            'status' => 1,
            'phoneNumberIndex' => 0,
            'createdAt' => [
                'date' => '2017-10-03T15:12:52+01:00'
            ],
            'uploadedCsvFile' => [
                'data' => [
                    'id' => 1,
                    'rows' => [['447123456789']],
                    'possiblePhoneColumns' => [0],
                    'originalFilename' => 'my-clients.txt',
                    'numRows' => 1,
                    'headings' => ['phoneNumber'],
                    'filesize' => '10.00 B',
                    'columnCount' => 1,
                    'filename' => 'my-clients.txt'
                ]
            ]
        ];

        $this->assertEquals($contactUploadResponse, $this->mapper->toArray($this->mapper->fromArray($contactUploadResponse, ContactUploadResponse::class)));
    }

    /** @test */
    public function toStdClass()
    {
        $expected = new \stdClass();
        $expected->id = 1;
        $expected->status = 1;
        $expected->phoneNumberIndex = 0;
        $expected->createdAt = new \stdClass();
        $expected->createdAt->date = '2017-10-03T15:12:52+01:00';
        $expected->uploadedCsvFile = new \stdClass();
        $expected->uploadedCsvFile->data = new \stdClass();
        $expected->uploadedCsvFile->data->id = 1;
        $expected->uploadedCsvFile->data->rows = [['447123456789']];
        $expected->uploadedCsvFile->data->possiblePhoneColumns = [0];
        $expected->uploadedCsvFile->data->originalFilename = 'my-clients.txt';
        $expected->uploadedCsvFile->data->numRows = 1;
        $expected->uploadedCsvFile->data->headings = ['phoneNumber'];
        $expected->uploadedCsvFile->data->filesize = '10.00 B';
        $expected->uploadedCsvFile->data->columnCount = 1;
        $expected->uploadedCsvFile->data->filename = 'my-clients.txt';

        $this->assertEquals($expected, $this->mapper->toStdClass($this->contactUploadResponse));
    }

    /** @test */
    public function fromStdClass()
    {
        $contactUploadResponse = new \stdClass();
        $contactUploadResponse->id = 1;
        $contactUploadResponse->status = 1;
        $contactUploadResponse->phoneNumberIndex = 0;
        $contactUploadResponse->createdAt = new \stdClass();
        $contactUploadResponse->createdAt->date = '2017-10-03T15:12:52+01:00';
        $contactUploadResponse->uploadedCsvFile = new \stdClass();
        $contactUploadResponse->uploadedCsvFile->data = new \stdClass();
        $contactUploadResponse->uploadedCsvFile->data->id = 1;
        $contactUploadResponse->uploadedCsvFile->data->rows = [['447123456789']];
        $contactUploadResponse->uploadedCsvFile->data->possiblePhoneColumns = [0];
        $contactUploadResponse->uploadedCsvFile->data->originalFilename = 'my-clients.txt';
        $contactUploadResponse->uploadedCsvFile->data->numRows = 1;
        $contactUploadResponse->uploadedCsvFile->data->headings = ['phoneNumber'];
        $contactUploadResponse->uploadedCsvFile->data->filesize = '10.00 B';
        $contactUploadResponse->uploadedCsvFile->data->columnCount = 1;
        $contactUploadResponse->uploadedCsvFile->data->filename = 'my-clients.txt';

        $this->assertEquals($this->contactUploadResponse, $this->mapper->fromStdClass($contactUploadResponse, ContactUploadResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_stdClass()
    {
        $contactUploadResponse = new \stdClass();
        $contactUploadResponse->id = 1;
        $contactUploadResponse->status = 1;
        $contactUploadResponse->phoneNumberIndex = 0;
        $contactUploadResponse->createdAt = new \stdClass();
        $contactUploadResponse->createdAt->date = '2017-10-03T15:12:52+01:00';
        $contactUploadResponse->uploadedCsvFile = new \stdClass();
        $contactUploadResponse->uploadedCsvFile->data = new \stdClass();
        $contactUploadResponse->uploadedCsvFile->data->id = 1;
        $contactUploadResponse->uploadedCsvFile->data->rows = [['447123456789']];
        $contactUploadResponse->uploadedCsvFile->data->possiblePhoneColumns = [0];
        $contactUploadResponse->uploadedCsvFile->data->originalFilename = 'my-clients.txt';
        $contactUploadResponse->uploadedCsvFile->data->numRows = 1;
        $contactUploadResponse->uploadedCsvFile->data->headings = ['phoneNumber'];
        $contactUploadResponse->uploadedCsvFile->data->filesize = '10.00 B';
        $contactUploadResponse->uploadedCsvFile->data->columnCount = 1;
        $contactUploadResponse->uploadedCsvFile->data->filename = 'my-clients.txt';


        $this->assertEquals($contactUploadResponse, $this->mapper->toStdClass($this->mapper->fromStdClass($contactUploadResponse, ContactUploadResponse::class)));
    }

    /** @test */
    public function toJson()
    {
        $expected = '{"id":1,"status":1,"createdAt":{"date":"2017-10-03T15:12:52+01:00"},"phoneNumberIndex":0,"uploadedCsvFile":{"data":{"id":1,"filename":"my-clients.txt","filesize":"10.00 B","columnCount":1,"numRows":1,"headings":["phoneNumber"],"rows":[["447123456789"]],"originalFilename":"my-clients.txt","possiblePhoneColumns":[0]}}}';

        $this->assertEquals($expected, $this->mapper->toJson($this->contactUploadResponse));
    }

    /** @test */
    public function fromJson()
    {
        $contactUploadResponse = '{"id":1,"status":1,"createdAt":{"date":"2017-10-03T15:12:52+01:00"},"phoneNumberIndex":0,"uploadedCsvFile":{"data":{"id":1,"filename":"my-clients.txt","filesize":"10.00 B","columnCount":1,"numRows":1,"headings":["phoneNumber"],"rows":[["447123456789"]],"originalFilename":"my-clients.txt","possiblePhoneColumns":[0]}}}';

        $this->assertEquals($this->contactUploadResponse, $this->mapper->fromJson($contactUploadResponse, ContactUploadResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_json()
    {
        $contactUploadResponse = '{"id":1,"status":1,"createdAt":{"date":"2017-10-03T15:12:52+01:00"},"phoneNumberIndex":0,"uploadedCsvFile":{"data":{"id":1,"filename":"my-clients.txt","filesize":"10.00 B","columnCount":1,"numRows":1,"headings":["phoneNumber"],"rows":[["447123456789"]],"originalFilename":"my-clients.txt","possiblePhoneColumns":[0]}}}';

        $this->assertEquals($contactUploadResponse, $this->mapper->toJson($this->mapper->fromJson($contactUploadResponse, ContactUploadResponse::class)));
    }
}
