<?php


namespace Tests\Feature;


use Digitonic\PassonaClient\Entities\LinkRequest;
use Digitonic\PassonaClient\Entities\LinkResponse;
use Digitonic\PassonaClient\Entities\TemplateRequest;
use Digitonic\PassonaClient\Entities\TemplateResponse;
use Digitonic\PassonaClient\Entities\VanityDomainResponse;

class TemplateCrudManagementTest extends ClientTestCase
{
    /**
     * @var TemplateResponse
     */
    private $templateResponse1;
    /**
     * @var TemplateResponse
     */
    private $templateResponse2;

    public function setUp()
    {
        parent::setUp();
        $vanityDomainResponse1 = new VanityDomainResponse();
        $vanityDomainResponse1->setId(1);
        $vanityDomainResponse1->setStatus(1);
        $vanityDomainResponse1->setNameservers(['my nameserver']);
        $vanityDomainResponse1->setDomain('my-domain');
        $vanityDomainResponse1->setHostedZoneId('my hosted zone id');

        $linkResponse1 = new LinkResponse();
        $linkResponse1->setId(1);
        $linkResponse1->setName('my link');
        $linkResponse1->setDestination('http://my.destination.co.uk');
        $linkResponse1->setVanityDomainId(1);
        $linkResponse1->setVanityDomainDomain('my-domain');
        $linkResponse1->setDeleted(false);
        $linkResponse1->setVanityDomain($vanityDomainResponse1);

        $this->templateResponse1 = new TemplateResponse();
        $this->templateResponse1->setId(1);
        $this->templateResponse1->setName('Test 1');
        $this->templateResponse1->setBody('Test 1');
        $this->templateResponse1->setLinks([$linkResponse1]);

        $vanityDomainResponse2 = new VanityDomainResponse();
        $vanityDomainResponse2->setId(2);
        $vanityDomainResponse2->setStatus(0);
        $vanityDomainResponse2->setNameservers(['my nameserver 2']);
        $vanityDomainResponse2->setDomain('my-domain 2');
        $vanityDomainResponse2->setHostedZoneId('my hosted zone id 2');

        $linkResponse2 = new LinkResponse();
        $linkResponse2->setId(2);
        $linkResponse2->setName('my link 2');
        $linkResponse2->setDestination('http://my.destination.com');
        $linkResponse2->setVanityDomainId(2);
        $linkResponse2->setVanityDomainDomain('my-domain 2');
        $linkResponse2->setDeleted(false);
        $linkResponse2->setVanityDomain($vanityDomainResponse2);

        $this->templateResponse2 = new TemplateResponse();
        $this->templateResponse2->setId(2);
        $this->templateResponse2->setName('Test 2');
        $this->templateResponse2->setBody('Test 2');
        $this->templateResponse2->setLinks([$linkResponse2]);
    }

    /** @test */
    public function getAllTemplates()
    {
        $expected = [$this->templateResponse1, $this->templateResponse2];

        $this->assertEquals($expected, $this->client->getAllTemplates());
    }

    /** @test */
    public function getTemplate()
    {
        $this->assertEquals($this->templateResponse1, $this->client->getTemplate(1));
    }

    /** @test */
    public function postTemplate()
    {
        $templateRequest = new TemplateRequest();
        $templateRequest->setName($this->templateResponse1->getName());
        $templateRequest->setBody($this->templateResponse1->getBody());

        $linkRequests = [];
        /** @var LinkResponse $linkResponse */
        foreach($this->templateResponse1->getLinks() as $linkResponse){
            $linkRequest = new LinkRequest();
            $linkRequest->setName($linkResponse->getName());
            $linkRequest->setVanityDomainId($linkResponse->getVanityDomainId());
            $linkRequest->setDestination($linkResponse->getDestination());
            $linkRequests[] = $linkRequest;
        }
        $templateRequest->setLinks($linkRequests);

        $this->assertEquals($this->templateResponse1, $this->client->postTemplate($templateRequest));
    }

    /** @test */
    public function putTemplate()
    {
        $this->templateResponse1->setName('Updated name');

        $templateRequest = new TemplateRequest();
        $templateRequest->setBody($this->templateResponse1->getBody());
        $templateRequest->setName($this->templateResponse1->getName());

        $linkRequests = [];
        /** @var LinkResponse $linkResponse */
        foreach ($this->templateResponse1->getLinks() as $linkResponse){
            $linkRequest = new LinkRequest();
            $linkRequest->setName($linkResponse->getName());
            $linkRequest->setDestination($linkResponse->getDestination());
            $linkRequest->setVanityDomainId($linkResponse->getVanityDomainId());
            $linkRequests[] = $linkRequest;
        }
        $templateRequest->setLinks($linkRequests);

        $this->assertEquals($this->templateResponse1, $this->client->putTemplate($this->templateResponse1->getId(), $templateRequest));
    }

    /** @test */
    public function deleteTemplate()
    {
        $this->assertEquals(true, $this->client->deleteTemplate($this->templateResponse1->getId()));
    }
}