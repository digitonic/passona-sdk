<?php

namespace Tests\Unit\Mappers\Requests;

use Carbon\Carbon;
use Digitonic\PassonaClient\Entities\CampaignRequest;
use Digitonic\PassonaClient\Entities\LinkRequest;
use Digitonic\PassonaClient\Mappers\Requests\CampaignRequestMapper;
use Digitonic\PassonaClient\Mappers\Requests\LinkRequestMapper;
use PHPUnit\Framework\TestCase;

/**
 * @property CampaignRequestMapper mapper
 * @property CampaignRequest campaign1
 */
class CampaignRequestMapperTest extends TestCase
{
    public function setUp()
    {
        $link1 = new LinkRequest();
        $link1->setName('my link');
        $link1->setDestination('http://my.destination.co.uk');
        $link1->setVanityDomainId(1);

        $link2 = new LinkRequest();
        $link2->setName('my link 2');
        $link2->setDestination('http://my.destination.com');
        $link2->setVanityDomainId(2);

        $this->campaign1 = new CampaignRequest();
        $this->campaign1->setTemplateId(1);
        $this->campaign1->setName('my first campaign');
        $this->campaign1->setSender('sender');
        $this->campaign1->setRecipientType('groups');
        $this->campaign1->setIncludedContactGroupIds([1]);
        $this->campaign1->setExcludedContactGroupIds([2]);
        $this->campaign1->setScheduledSend(true);
        $this->campaign1->setLinks([
            $link1, $link2
        ]);
        $this->campaign1->setScheduledSendDate(Carbon::parse('2017-09-26 14:30:21'));
        $this->campaign1->setExpiryDate(Carbon::parse('2017-09-27 16:28:33'));

        $this->mapper = new CampaignRequestMapper(new LinkRequestMapper());
    }

    /** @test */
    public function toArray()
    {
        $expected = [
            'name' => 'my first campaign',
            'templateId' => 1,
            'sender' => 'sender',
            'expiryDate' => '2017-09-27 16:28:33',
            'recipientType' => 'groups',
            'includedContactGroupIds' => [1],
            'excludedContactGroupIds' => [2],
            'scheduledSendDate' => '2017-09-26 14:30:21',
            'links' => [
                [
                    'name' => 'my link',
                    'destination' => 'http://my.destination.co.uk',
                    'vanityDomainId' => 1,
                ],
                ['name' => 'my link 2',
                    'destination' => 'http://my.destination.com',
                    'vanityDomainId' => 2
                ]
            ]
        ];

        $this->assertEquals($expected, $this->mapper->toArray($this->campaign1));
    }

    /** @test */
    public function fromArray()
    {
        $campaignArray = [
            'name' => 'my first campaign',
            'templateId' => 1,
            'sender' => 'sender',
            'expiryDate' => '2017-09-27 16:28:33',
            'recipientType' => 'groups',
            'includedContactGroupIds' => [1],
            'excludedContactGroupIds' => [2],
            'scheduledSendDate' => '2017-09-26 14:30:21',
            'links' => [
                [
                    'name' => 'my link',
                    'destination' => 'http://my.destination.co.uk',
                    'vanityDomainId' => 1,
                ],
                ['name' => 'my link 2',
                    'destination' => 'http://my.destination.com',
                    'vanityDomainId' => 2
                ]
            ]
        ];

        $this->assertEquals($this->campaign1, $this->mapper->fromArray($campaignArray, CampaignRequest::class));
    }

    /** @test */
    public function toStdClass()
    {
        $expected = new \stdClass();
        $expected->name = 'my first campaign';
        $expected->templateId = 1;
        $expected->sender = 'sender';
        $expected->expiryDate = '2017-09-27 16:28:33';
        $expected->recipientType = 'groups';
        $expected->includedContactGroupIds = [1];
        $expected->excludedContactGroupIds = [2];
        $expected->scheduledSendDate = '2017-09-26 14:30:21';

        $link1 = new \stdClass();
        $link1->name = 'my link';
        $link1->destination = 'http://my.destination.co.uk';
        $link1->vanityDomainId = 1;

        $link2 = new \stdClass();
        $link2->name = 'my link 2';
        $link2->destination = 'http://my.destination.com';
        $link2->vanityDomainId = 2;

        $expected->links = [$link1, $link2];

        $this->assertEquals($expected, $this->mapper->toStdClass($this->campaign1));
    }

    /** @test */
    public function fromStdClass()
    {
        $campaignStdClass = new \stdClass();
        $campaignStdClass->name = 'my first campaign';
        $campaignStdClass->templateId = 1;
        $campaignStdClass->sender = 'sender';
        $campaignStdClass->expiryDate = '2017-09-27 16:28:33';
        $campaignStdClass->recipientType = 'groups';
        $campaignStdClass->includedContactGroupIds = [1];
        $campaignStdClass->excludedContactGroupIds = [2];
        $campaignStdClass->scheduledSendDate = '2017-09-26 14:30:21';

        $link1 = new \stdClass();
        $link1->name = 'my link';
        $link1->destination = 'http://my.destination.co.uk';
        $link1->vanityDomainId = 1;

        $link2 = new \stdClass();
        $link2->name = 'my link 2';
        $link2->destination = 'http://my.destination.com';
        $link2->vanityDomainId = 2;

        $campaignStdClass->links = [$link1, $link2];

        $this->assertEquals($this->campaign1, $this->mapper->fromStdClass($campaignStdClass, CampaignRequest::class));
    }

    /** @test */
    public function toJson()
    {
        $expected = '{"name":"my first campaign","sender":"sender","expiryDate":"2017-09-27 16:28:33","recipientType":"groups","templateId":1,"includedContactGroupIds":[1],"excludedContactGroupIds":[2],"scheduledSendDate":"2017-09-26 14:30:21","links":[{"name":"my link","destination":"http:\/\/my.destination.co.uk","vanityDomainId":1},{"name":"my link 2","destination":"http:\/\/my.destination.com","vanityDomainId":2}]}';

        $this->assertEquals($expected, $this->mapper->toJson($this->campaign1));
    }

    /** @test */
    public function fromJson()
    {
        $campaignJson = '{"name":"my first campaign","sender":"sender","expiryDate":"2017-09-27 16:28:33","recipientType":"groups","templateId":1,"includedContactGroupIds":[1],"excludedContactGroupIds":[2],"scheduledSendDate":"2017-09-26 14:30:21","links":[{"name":"my link","destination":"http:\/\/my.destination.co.uk","vanityDomainId":1},{"name":"my link 2","destination":"http:\/\/my.destination.com","vanityDomainId":2}]}';

        $this->assertEquals($this->campaign1, $this->mapper->fromJson($campaignJson, CampaignRequest::class));
    }

    /** @test */
    public function bidirectional_mapping_json()
    {
        $campaignJson = '{"name":"my first campaign","sender":"sender","expiryDate":"2017-09-27 16:28:33","recipientType":"groups","templateId":1,"includedContactGroupIds":[1],"excludedContactGroupIds":[2],"scheduledSendDate":"2017-09-26 14:30:21","links":[{"name":"my link","destination":"http:\/\/my.destination.co.uk","vanityDomainId":1},{"name":"my link 2","destination":"http:\/\/my.destination.com","vanityDomainId":2}]}';

        $this->assertEquals($campaignJson, $this->mapper->toJson($this->mapper->fromJson($campaignJson, CampaignRequest::class)));
    }

    /** @test */
    public function bidirectional_mapping_array()
    {
        $campaignArray = [
            'name' => 'my first campaign',
            'templateId' => 1,
            'sender' => 'sender',
            'expiryDate' => '2017-09-27 16:28:33',
            'recipientType' => 'groups',
            'includedContactGroupIds' => [1],
            'excludedContactGroupIds' => [2],
            'scheduledSendDate' => '2017-09-26 14:30:21',
            'links' => [
                [
                    'name' => 'my link',
                    'destination' => 'http://my.destination.co.uk',
                    'vanityDomainId' => 1,
                ],
                ['name' => 'my link 2',
                    'destination' => 'http://my.destination.com',
                    'vanityDomainId' => 2
                ]
            ]
        ];

        $this->assertEquals($campaignArray, $this->mapper->toArray($this->mapper->fromArray($campaignArray)));
    }

    /** @test */
    public function bidirectional_mapping_stdClass()
    {
        $campaignStdClass = new \stdClass();
        $campaignStdClass->name = 'my first campaign';
        $campaignStdClass->templateId = 1;
        $campaignStdClass->sender = 'sender';
        $campaignStdClass->expiryDate = '2017-09-27 16:28:33';
        $campaignStdClass->recipientType = 'groups';
        $campaignStdClass->includedContactGroupIds = [1];
        $campaignStdClass->excludedContactGroupIds = [2];
        $campaignStdClass->scheduledSendDate = '2017-09-26 14:30:21';

        $link1 = new \stdClass();
        $link1->name = 'my link';
        $link1->destination = 'http://my.destination.co.uk';
        $link1->vanityDomainId = 1;

        $link2 = new \stdClass();
        $link2->name = 'my link 2';
        $link2->destination = 'http://my.destination.com';
        $link2->vanityDomainId = 2;

        $campaignStdClass->links = [$link1, $link2];

        $this->assertEquals($campaignStdClass, $this->mapper->toStdClass($this->mapper->fromStdClass($campaignStdClass)));
    }

}
