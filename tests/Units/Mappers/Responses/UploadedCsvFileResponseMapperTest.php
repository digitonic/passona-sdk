<?php

namespace Tests\Unit\Mappers\Responses;

use Digitonic\PassonaClient\Entities\UploadedCsvFileResponse;
use Digitonic\PassonaClient\Mappers\Responses\UploadedCsvFileResponseMapper;

/**
 * @property UploadedCsvFileResponseMapper mapper
 * @property UploadedCsvFileResponse uploadedCsvFileResponse
 */
class UploadedCsvFileResponseMapperTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->mapper = new UploadedCsvFileResponseMapper();

        $this->uploadedCsvFileResponse = new UploadedCsvFileResponse();
        $this->uploadedCsvFileResponse->setId(1);
        $this->uploadedCsvFileResponse->setRows([['447123456789']]);
        $this->uploadedCsvFileResponse->setPossiblePhoneColumns([0]);
        $this->uploadedCsvFileResponse->setOriginalFilename('my-clients.txt');
        $this->uploadedCsvFileResponse->setNumRows(1);
        $this->uploadedCsvFileResponse->setHeadings(['phoneNumber']);
        $this->uploadedCsvFileResponse->setFilesize('10.00 B');
        $this->uploadedCsvFileResponse->setColumnCount(1);
        $this->uploadedCsvFileResponse->setFilename('my-clients.txt');
    }

    /** @test */
    public function toArray()
    {
        $expected = [
            'id' => 1,
            'rows' => [['447123456789']],
            'possiblePhoneColumns' => [0],
            'originalFilename' => 'my-clients.txt',
            'numRows' => 1,
            'headings' => ['phoneNumber'],
            'filesize' => '10.00 B',
            'columnCount' => 1,
            'filename' => 'my-clients.txt'
        ];

        $this->assertEquals($expected, $this->mapper->toArray($this->uploadedCsvFileResponse));
    }

    /** @test */
    public function fromArray()
    {
        $uploadedCsvFileResponse = [
            'id' => 1,
            'rows' => [['447123456789']],
            'possiblePhoneColumns' => [0],
            'originalFilename' => 'my-clients.txt',
            'numRows' => 1,
            'headings' => ['phoneNumber'],
            'filesize' => '10.00 B',
            'columnCount' => 1,
            'filename' => 'my-clients.txt'
        ];

        $this->assertEquals($this->uploadedCsvFileResponse, $this->mapper->fromArray($uploadedCsvFileResponse, UploadedCsvFileResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_array()
    {
        $uploadedCsvFileResponse = [
            'id' => 1,
            'rows' => [['447123456789']],
            'possiblePhoneColumns' => [0],
            'originalFilename' => 'my-clients.txt',
            'numRows' => 1,
            'headings' => ['phoneNumber'],
            'filesize' => '10.00 B',
            'columnCount' => 1,
            'filename' => 'my-clients.txt'
        ];

        $this->assertEquals($uploadedCsvFileResponse, $this->mapper->toArray($this->mapper->fromArray($uploadedCsvFileResponse, UploadedCsvFileResponse::class)));
    }

    /** @test */
    public function toStdClass()
    {
        $expected = new \stdClass();
        $expected->id = 1;
        $expected->rows = [['447123456789']];
        $expected->possiblePhoneColumns = [0];
        $expected->originalFilename = 'my-clients.txt';
        $expected->numRows = 1;
        $expected->headings = ['phoneNumber'];
        $expected->filesize = '10.00 B';
        $expected->columnCount = 1;
        $expected->filename = 'my-clients.txt';

        $this->assertEquals($expected, $this->mapper->toStdClass($this->uploadedCsvFileResponse));
    }

    /** @test */
    public function fromStdClass()
    {
        $uploadedCsvFileResponse = new \stdClass();
        $uploadedCsvFileResponse->id = 1;
        $uploadedCsvFileResponse->rows = [['447123456789']];
        $uploadedCsvFileResponse->possiblePhoneColumns = [0];
        $uploadedCsvFileResponse->originalFilename = 'my-clients.txt';
        $uploadedCsvFileResponse->numRows = 1;
        $uploadedCsvFileResponse->headings = ['phoneNumber'];
        $uploadedCsvFileResponse->filesize = '10.00 B';
        $uploadedCsvFileResponse->columnCount = 1;
        $uploadedCsvFileResponse->filename = 'my-clients.txt';

        $this->assertEquals($this->uploadedCsvFileResponse, $this->mapper->fromStdClass($uploadedCsvFileResponse, UploadedCsvFileResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_stdClass()
    {
        $uploadedCsvFileResponse = new \stdClass();
        $uploadedCsvFileResponse->id = 1;
        $uploadedCsvFileResponse->rows = [['447123456789']];
        $uploadedCsvFileResponse->possiblePhoneColumns = [0];
        $uploadedCsvFileResponse->originalFilename = 'my-clients.txt';
        $uploadedCsvFileResponse->numRows = 1;
        $uploadedCsvFileResponse->headings = ['phoneNumber'];
        $uploadedCsvFileResponse->filesize = '10.00 B';
        $uploadedCsvFileResponse->columnCount = 1;
        $uploadedCsvFileResponse->filename = 'my-clients.txt';

        $this->assertEquals($uploadedCsvFileResponse, $this->mapper->toStdClass($this->mapper->fromStdClass($uploadedCsvFileResponse, UploadedCsvFileResponse::class)));
    }

    /** @test */
    public function toJson()
    {
        $expected = '{"id":1,"filename":"my-clients.txt","filesize":"10.00 B","columnCount":1,"numRows":1,"headings":["phoneNumber"],"rows":[["447123456789"]],"originalFilename":"my-clients.txt","possiblePhoneColumns":[0]}';

        $this->assertEquals($expected, $this->mapper->toJson($this->uploadedCsvFileResponse));
    }

    /** @test */
    public function fromJson()
    {
        $uploadedCsvFileResponse = '{"id":1,"filename":"my-clients.txt","filesize":"10.00 B","columnCount":1,"numRows":1,"headings":["phoneNumber"],"rows":[["447123456789"]],"originalFilename":"my-clients.txt","possiblePhoneColumns":[0]}';

        $this->assertEquals($this->uploadedCsvFileResponse, $this->mapper->fromJson($uploadedCsvFileResponse, UploadedCsvFileResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_json()
    {
        $uploadedCsvFileResponse = '{"id":1,"filename":"my-clients.txt","filesize":"10.00 B","columnCount":1,"numRows":1,"headings":["phoneNumber"],"rows":[["447123456789"]],"originalFilename":"my-clients.txt","possiblePhoneColumns":[0]}';

        $this->assertEquals($uploadedCsvFileResponse, $this->mapper->toJson($this->mapper->fromJson($uploadedCsvFileResponse, UploadedCsvFileResponse::class)));
    }
}
