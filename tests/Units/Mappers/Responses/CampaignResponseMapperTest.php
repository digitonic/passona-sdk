<?php

namespace Tests\Unit\Mappers\Responses;

use Carbon\Carbon;
use Digitonic\PassonaClient\Entities\CampaignResponse;
use Digitonic\PassonaClient\Entities\LinkResponse;
use Digitonic\PassonaClient\Entities\VanityDomainResponse;
use Digitonic\PassonaClient\Mappers\Responses\CampaignResponseMapper;
use Digitonic\PassonaClient\Mappers\Responses\LinkResponseMapper;
use Digitonic\PassonaClient\Mappers\Responses\VanityDomainResponseMapper;
use PHPUnit\Framework\TestCase;

/**
 * @property CampaignResponseMapper mapper
 * @property CampaignResponse campaignResponse
 */
class CampaignResponseMapperTest extends TestCase
{
    public function setUp()
    {
        $vanityDomainResponse = new VanityDomainResponse();
        $vanityDomainResponse->setId(1);
        $vanityDomainResponse->setNameservers(['nameserver1', 'nameserver2']);
        $vanityDomainResponse->setDomain('domain.com');
        $vanityDomainResponse->setHostedZoneId('1A2B3C4D');
        $vanityDomainResponse->setStatus(1);

        $linkResponse = new LinkResponse();
        $linkResponse->setName('Link Name');
        $linkResponse->setDestination('http://my.destination.com');
        $linkResponse->setId(1);
        $linkResponse->setVanityDomainId($vanityDomainResponse->getId());
        $linkResponse->setVanityDomainDomain($vanityDomainResponse->getDomain());
        $linkResponse->setDeleted(false);
        $linkResponse->setVanityDomain($vanityDomainResponse);

        $this->campaignResponse = new CampaignResponse();
        $this->campaignResponse->setName('Campaign Name');
        $this->campaignResponse->setLinks([]);
        $this->campaignResponse->setBody('Campaign Body');
        $this->campaignResponse->setScheduledSend(true);
        $this->campaignResponse->setScheduledSendDate(Carbon::parse('2017-10-03T11:10:28+01:00'));
        $this->campaignResponse->setRecipients(['447123456789', '447987654321']);
        $this->campaignResponse->setSender('Digitonic');
        $this->campaignResponse->setExpiryDate(Carbon::parse('2017-10-03T11:10:55+01:00'));
        $this->campaignResponse->setRecipientType('numbers');
        $this->campaignResponse->setFinishedSendingAt(Carbon::parse('2017-10-03T11:11:09+01:00'));
        $this->campaignResponse->setUpdatedAt(Carbon::parse('2017-10-03T11:11:14+01:00'));
        $this->campaignResponse->setCreatedAt(Carbon::parse('2017-10-03T11:10:14+01:00'));
        $this->campaignResponse->setIsEditable(true);
        $this->campaignResponse->setIsViewable(true);
        $this->campaignResponse->setStartedSendingAt(Carbon::parse('2017-10-03T11:10:43+01:00'));
        $this->campaignResponse->setStatusDescription('Pending');
        $this->campaignResponse->setStatusCode(2);
        $this->campaignResponse->setIsDeletable(true);
        $this->campaignResponse->setMessageTemplate('Campaign Body');
        $this->campaignResponse->setId(1);
        $this->campaignResponse->setNumberOfRecipient(2);

        $this->mapper = new CampaignResponseMapper(new LinkResponseMapper(new VanityDomainResponseMapper()));
    }

    /** @test */
    public function toArray()
    {
        $expected = [
            'name' => 'Campaign Name',
            'links' => [
                'data' => []
            ],
            'body' => 'Campaign Body',
            'scheduledSend' => true,
            'scheduledSendDate' => '2017-10-03T11:10:28+01:00',
            'recipients' => '447123456789,447987654321',
            'sender' => 'Digitonic',
            'expiryDate' => '2017-10-03T11:10:55+01:00',
            'recipientType' => 'numbers',
            'finishedSendingAt' => '2017-10-03T11:11:09+01:00',
            'updatedAt' => '2017-10-03T11:11:14+01:00',
            'createdAt' => '2017-10-03T11:10:14+01:00',
            'isEditable' => true,
            'isViewable' => true,
            'startedSendingAt' => '2017-10-03T11:10:43+01:00',
            'statusDescription' => 'Pending',
            'statusCode' => 2,
            'isDeletable' => true,
            'messageTemplate' => 'Campaign Body',
            'id' => 1,
            'numberOfRecipients' => 2
        ];

        $this->assertEquals($expected, $this->mapper->toArray($this->campaignResponse));
    }

    /** @test */
    public function fromArray()
    {
        $campaignResponse = [
            'name' => 'Campaign Name',
            'links' => [
                'data' => []
            ],
            'body' => 'Campaign Body',
            'scheduledSend' => true,
            'scheduledSendDate' => '2017-10-03T11:10:28+01:00',
            'recipients' => '447123456789,447987654321',
            'sender' => 'Digitonic',
            'expiryDate' => '2017-10-03T11:10:55+01:00',
            'recipientType' => 'numbers',
            'finishedSendingAt' => '2017-10-03T11:11:09+01:00',
            'updatedAt' => '2017-10-03T11:11:14+01:00',
            'createdAt' => '2017-10-03T11:10:14+01:00',
            'isEditable' => true,
            'isViewable' => true,
            'startedSendingAt' => '2017-10-03T11:10:43+01:00',
            'statusDescription' => 'Pending',
            'statusCode' => 2,
            'isDeletable' => true,
            'messageTemplate' => 'Campaign Body',
            'id' => 1,
            'numberOfRecipients' => 2
        ];

        $this->assertEquals($this->campaignResponse, $this->mapper->fromArray($campaignResponse, CampaignResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_array()
    {
        $campaignResponse = [
            'name' => 'Campaign Name',
            'links' => [
                'data' => []
            ],
            'body' => 'Campaign Body',
            'scheduledSend' => true,
            'scheduledSendDate' => '2017-10-03T11:10:28+01:00',
            'recipients' => '447123456789,447987654321',
            'sender' => 'Digitonic',
            'expiryDate' => '2017-10-03T11:10:55+01:00',
            'recipientType' => 'numbers',
            'finishedSendingAt' => '2017-10-03T11:11:09+01:00',
            'updatedAt' => '2017-10-03T11:11:14+01:00',
            'createdAt' => '2017-10-03T11:10:14+01:00',
            'isEditable' => true,
            'isViewable' => true,
            'startedSendingAt' => '2017-10-03T11:10:43+01:00',
            'statusDescription' => 'Pending',
            'statusCode' => 2,
            'isDeletable' => true,
            'messageTemplate' => 'Campaign Body',
            'id' => 1,
            'numberOfRecipients' => 2
        ];

        $this->assertEquals($campaignResponse, $this->mapper->toArray($this->mapper->fromArray($campaignResponse, CampaignResponse::class)));
    }

    /** @test */
    public function toStdClass()
    {
        $expected = new \stdClass();
        $expected->name = 'Campaign Name';
        $expected->links = new \stdClass();
        $expected->links->data = [];
        $expected->body = 'Campaign Body';
        $expected->scheduledSend = true;
        $expected->scheduledSendDate = '2017-10-03T11:10:28+01:00';
        $expected->recipients = '447123456789,447987654321';
        $expected->sender = 'Digitonic';
        $expected->expiryDate = '2017-10-03T11:10:55+01:00';
        $expected->recipientType = 'numbers';
        $expected->finishedSendingAt = '2017-10-03T11:11:09+01:00';
        $expected->updatedAt = '2017-10-03T11:11:14+01:00';
        $expected->createdAt = '2017-10-03T11:10:14+01:00';
        $expected->isEditable = true;
        $expected->isViewable = true;
        $expected->startedSendingAt = '2017-10-03T11:10:43+01:00';
        $expected->statusDescription = 'Pending';
        $expected->statusCode = 2;
        $expected->isDeletable = true;
        $expected->messageTemplate = 'Campaign Body';
        $expected->id = 1;
        $expected->numberOfRecipients = 2;

        $this->assertEquals($expected, $this->mapper->toStdClass($this->campaignResponse));
    }

    /** @test */
    public function fromStdClass()
    {
        $campaignResponse = new \stdClass();
        $campaignResponse->name = 'Campaign Name';
        $campaignResponse->links = new \stdClass();
        $campaignResponse->links->data = [];
        $campaignResponse->body = 'Campaign Body';
        $campaignResponse->scheduledSend = true;
        $campaignResponse->scheduledSendDate = '2017-10-03T11:10:28+01:00';
        $campaignResponse->recipients = '447123456789,447987654321';
        $campaignResponse->sender = 'Digitonic';
        $campaignResponse->expiryDate = '2017-10-03T11:10:55+01:00';
        $campaignResponse->recipientType = 'numbers';
        $campaignResponse->finishedSendingAt = '2017-10-03T11:11:09+01:00';
        $campaignResponse->updatedAt = '2017-10-03T11:11:14+01:00';
        $campaignResponse->createdAt = '2017-10-03T11:10:14+01:00';
        $campaignResponse->isEditable = true;
        $campaignResponse->isViewable = true;
        $campaignResponse->startedSendingAt = '2017-10-03T11:10:43+01:00';
        $campaignResponse->statusDescription = 'Pending';
        $campaignResponse->statusCode = 2;
        $campaignResponse->isDeletable = true;
        $campaignResponse->messageTemplate = 'Campaign Body';
        $campaignResponse->id = 1;
        $campaignResponse->numberOfRecipients = 2;

        $this->assertEquals($this->campaignResponse, $this->mapper->fromStdClass($campaignResponse, CampaignResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_stdClass()
    {
        $campaignResponse = new \stdClass();
        $campaignResponse->name = 'Campaign Name';
        $campaignResponse->links = new \stdClass();
        $campaignResponse->links->data = [];
        $campaignResponse->body = 'Campaign Body';
        $campaignResponse->scheduledSend = true;
        $campaignResponse->scheduledSendDate = '2017-10-03T11:10:28+01:00';
        $campaignResponse->recipients = '447123456789,447987654321';
        $campaignResponse->sender = 'Digitonic';
        $campaignResponse->expiryDate = '2017-10-03T11:10:55+01:00';
        $campaignResponse->recipientType = 'numbers';
        $campaignResponse->finishedSendingAt = '2017-10-03T11:11:09+01:00';
        $campaignResponse->updatedAt = '2017-10-03T11:11:14+01:00';
        $campaignResponse->createdAt = '2017-10-03T11:10:14+01:00';
        $campaignResponse->isEditable = true;
        $campaignResponse->isViewable = true;
        $campaignResponse->startedSendingAt = '2017-10-03T11:10:43+01:00';
        $campaignResponse->statusDescription = 'Pending';
        $campaignResponse->statusCode = 2;
        $campaignResponse->isDeletable = true;
        $campaignResponse->messageTemplate = 'Campaign Body';
        $campaignResponse->id = 1;
        $campaignResponse->numberOfRecipients = 2;

        $this->assertEquals($campaignResponse, $this->mapper->toStdClass($this->mapper->fromStdClass($campaignResponse, CampaignResponse::class)));
    }

    /** @test */
    public function toJson()
    {
        $expected = '{"id":1,"name":"Campaign Name","messageTemplate":"Campaign Body","sender":"Digitonic","scheduledSend":true,"statusCode":2,"statusDescription":"Pending","startedSendingAt":"2017-10-03T11:10:43+01:00","isViewable":true,"isEditable":true,"isDeletable":true,"createdAt":"2017-10-03T11:10:14+01:00","updatedAt":"2017-10-03T11:11:14+01:00","expiryDate":"2017-10-03T11:10:55+01:00","body":"Campaign Body","finishedSendingAt":"2017-10-03T11:11:09+01:00","numberOfRecipients":2,"recipientType":"numbers","recipients":"447123456789,447987654321","scheduledSendDate":"2017-10-03T11:10:28+01:00","links":{"data":[]}}';

        $this->assertEquals($expected, $this->mapper->toJson($this->campaignResponse));
    }

    /** @test */
    public function fromJson()
    {
        $campaignResponse = '{"id":1,"name":"Campaign Name","messageTemplate":"Campaign Body","sender":"Digitonic","scheduledSend":true,"statusCode":2,"statusDescription":"Pending","startedSendingAt":"2017-10-03T11:10:43+01:00","isViewable":true,"isEditable":true,"isDeletable":true,"createdAt":"2017-10-03T11:10:14+01:00","updatedAt":"2017-10-03T11:11:14+01:00","expiryDate":"2017-10-03T11:10:55+01:00","body":"Campaign Body","finishedSendingAt":"2017-10-03T11:11:09+01:00","numberOfRecipients":2,"recipientType":"numbers","recipients":"447123456789,447987654321","scheduledSendDate":"2017-10-03T11:10:28+01:00","links":{"data":[]}}';

        $this->assertEquals($this->campaignResponse, $this->mapper->fromJson($campaignResponse, CampaignResponse::class));
    }

    /** @test */
    public function bidirectional_mapping_json()
    {
        $campaignResponse = '{"id":1,"name":"Campaign Name","messageTemplate":"Campaign Body","sender":"Digitonic","scheduledSend":true,"statusCode":2,"statusDescription":"Pending","startedSendingAt":"2017-10-03T11:10:43+01:00","isViewable":true,"isEditable":true,"isDeletable":true,"createdAt":"2017-10-03T11:10:14+01:00","updatedAt":"2017-10-03T11:11:14+01:00","expiryDate":"2017-10-03T11:10:55+01:00","body":"Campaign Body","finishedSendingAt":"2017-10-03T11:11:09+01:00","numberOfRecipients":2,"recipientType":"numbers","recipients":"447123456789,447987654321","scheduledSendDate":"2017-10-03T11:10:28+01:00","links":{"data":[]}}';

        $this->assertEquals($campaignResponse, $this->mapper->toJson($this->mapper->fromJson($campaignResponse, CampaignResponse::class)));
    }

}
