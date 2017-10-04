<?php


namespace Tests\Feature;


use Digitonic\PassonaClient\Entities\CampaignResponse;
use Digitonic\PassonaClient\Entities\LinkRequest;
use Carbon\Carbon;
use Digitonic\PassonaClient\Entities\CampaignRequest;
use Digitonic\PassonaClient\Entities\LinkResponse;
use Digitonic\PassonaClient\Entities\VanityDomainResponse;

class CampaignCrudManagementTest extends ClientTestCase
{
    /**
     * @var CampaignRequest
     */
    private $campaign1;
    /**
     * @var CampaignRequest
     */
    private $campaign2;

    public function setUp()
    {
        parent::setUp();
        $vanityDomain1 = $this->buildVanityDomain(1,1,['my nameserver'],'my-domain','my hosted zone id');
        $link1 = $this->buildLink(1,'my link', 'http://my.destination.co.uk', false, $vanityDomain1);
        $vanityDomain2 = $this->buildVanityDomain(2,0,['my nameserver 2'],'my-domain 2','my hosted zone id 2');
        $link2 = $this->buildLink(2,'my link 2', 'http://my.destination.com', false, $vanityDomain2);


        $this->campaign1 = new CampaignResponse();
        $this->campaign1->setId(1);
        $this->campaign1->setName('my first campaign');
        $this->campaign1->setStatusCode(2);
        $this->campaign1->setStatusDescription('Pending');
        $this->campaign1->setBody('my body is ready');
        $this->campaign1->setSender('sender');
        $this->campaign1->setMessageTemplate('my body is ready');
        $this->campaign1->setNumberOfRecipient(1);
        $this->campaign1->setRecipientType('groups');
        $this->campaign1->setIncludedContactGroupIds([1]);
        $this->campaign1->setExcludedContactGroupIds([2]);
        $this->campaign1->setIsDeletable(false);
        $this->campaign1->setIsEditable(false);
        $this->campaign1->setIsViewable(false);
        $this->campaign1->setScheduledSend(true);
        $this->campaign1->setLinks([
            $link1, $link2
        ]);
        $this->campaign1->setFinishedSendingAt(Carbon::parse('2017-09-26 16:29:39'));
        $this->campaign1->setScheduledSendDate(Carbon::parse('2017-09-26 14:30:21'));
        $this->campaign1->setStartedSendingAt(Carbon::parse('2017-09-26 14:32:14'));
        $this->campaign1->setExpiryDate(Carbon::parse('2017-09-27 16:28:33'));
        $this->campaign1->setUpdatedAt(Carbon::parse('2017-09-26 16:27:20'));
        $this->campaign1->setCreatedAt(Carbon::parse('2017-09-26 16:27:02'));

        $this->campaign2 = new CampaignResponse();
        $this->campaign2->setId(2);
        $this->campaign2->setName('my second campaign');
        $this->campaign2->setStatusCode(1);
        $this->campaign2->setStatusDescription('Queued');
        $this->campaign2->setBody('my body is also ready');
        $this->campaign2->setSender('Bernie');
        $this->campaign2->setMessageTemplate('my body is also ready');
        $this->campaign2->setNumberOfRecipient(10);
        $this->campaign2->setRecipientType('numbers');
        $this->campaign2->setRecipients(['447123456789', '447987654321']);
        $this->campaign2->setIsDeletable(false);
        $this->campaign2->setIsEditable(false);
        $this->campaign2->setIsViewable(false);
        $this->campaign2->setScheduledSend(false);
        $this->campaign2->setFinishedSendingAt(Carbon::parse('2017-09-26 16:29:39'));
        $this->campaign2->setStartedSendingAt(Carbon::parse('2017-09-26 14:32:14'));
        $this->campaign2->setExpiryDate(Carbon::parse('2017-09-27 16:28:33'));
        $this->campaign2->setUpdatedAt(Carbon::parse('2017-09-26 16:27:20'));
        $this->campaign2->setCreatedAt(Carbon::parse('2017-09-26 16:27:02'));

    }

    /** @test */
    public function getAllCampaigns()
    {
        $this->assertEquals([$this->campaign1, $this->campaign2], $this->client->getAllCampaigns());
    }

    /** @test */
    public function getCampaign()
    {
        $this->assertEquals($this->campaign1, $this->client->getCampaign(1));
    }

    /** @test */
    public function postCampaign()
    {
        $campaignRequest = new CampaignRequest();
        $campaignRequest->setName($this->campaign1->getName());
        $campaignRequest->setBody($this->campaign1->getBody());
        $campaignRequest->setScheduledSendDate($this->campaign1->getScheduledSendDate());
        $campaignRequest->setIncludedContactGroupIds($this->campaign1->getIncludedContactGroupIds());
        $campaignRequest->setExcludedContactGroupIds($this->campaign1->getExcludedContactGroupIds());
        $campaignRequest->setRecipientType($this->campaign1->getRecipientType());
        $campaignRequest->setExpiryDate($this->campaign1->getExpiryDate());
        $campaignRequest->setSender($this->campaign1->getSender());
        $campaignRequest->setMessageTemplateId(1);

        /** @var LinkResponse $linkResponse */
        foreach($this->campaign1->getLinks() as $linkResponse){
            $linkRequest = new LinkRequest();
            $linkRequest->setName($linkResponse->getName());
            $linkRequest->setDestination($linkResponse->getDestination());
            $linkRequest->setVanityDomainId($linkResponse->getVanityDomainId());
            $campaignRequest->addLink($linkRequest);
        }

        $this->assertEquals($this->campaign1, $this->client->postCampaign($campaignRequest));
    }

    /** @test */
    public function putCampaign()
    {
        $this->campaign1->setBody('Updated Body');
        $campaignRequest = new CampaignRequest();
        $campaignRequest->setName($this->campaign1->getName());
        $campaignRequest->setBody($this->campaign1->getBody());
        $campaignRequest->setScheduledSendDate($this->campaign1->getScheduledSendDate());
        $campaignRequest->setIncludedContactGroupIds($this->campaign1->getIncludedContactGroupIds());
        $campaignRequest->setExcludedContactGroupIds($this->campaign1->getExcludedContactGroupIds());
        $campaignRequest->setRecipientType($this->campaign1->getRecipientType());
        $campaignRequest->setExpiryDate($this->campaign1->getExpiryDate());
        $campaignRequest->setSender($this->campaign1->getSender());
        $campaignRequest->setMessageTemplateId(1);

        /** @var LinkResponse $linkResponse */
        foreach($this->campaign1->getLinks() as $linkResponse){
            $linkRequest = new LinkRequest();
            $linkRequest->setName($linkResponse->getName());
            $linkRequest->setDestination($linkResponse->getDestination());
            $linkRequest->setVanityDomainId($linkResponse->getVanityDomainId());
            $campaignRequest->addLink($linkRequest);
        }

        $this->assertEquals($this->campaign1, $this->client->putCampaign($this->campaign1->getId(), $campaignRequest));
    }

    /** @test */
    public function deleteCampaign()
    {
        $this->assertTrue($this->client->deleteCampaign($this->campaign1->getId()));
    }

    /**
     * @return VanityDomainResponse
     */
    private function buildVanityDomain(int $id, int $status, array $nameservers, string $domain, string $hostedZoneId): VanityDomainResponse
    {
        $vanityDomain = new VanityDomainResponse();
        $vanityDomain->setId($id);
        $vanityDomain->setStatus($status);
        $vanityDomain->setNameservers($nameservers);
        $vanityDomain->setDomain($domain);
        $vanityDomain->setHostedZoneId($hostedZoneId);

        return $vanityDomain;
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $destination
     * @param bool $deleted
     * @param VanityDomainResponse $vanityDomain
     * @return LinkResponse
     */
    private function buildLink(int $id, string $name, string $destination, bool $deleted, VanityDomainResponse $vanityDomain): LinkResponse
    {
        $link = new LinkResponse();
        $link->setId($id);
        $link->setName($name);
        $link->setDestination($destination);
        $link->setVanityDomainId($vanityDomain->getId());
        $link->setVanityDomainDomain($vanityDomain->getDomain());
        $link->setDeleted($deleted);
        $link->setVanityDomain($vanityDomain);

        return $link;
    }
}