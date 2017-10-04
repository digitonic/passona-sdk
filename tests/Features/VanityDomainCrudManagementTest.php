<?php


namespace Tests\Feature;


use Digitonic\PassonaClient\Entities\VanityDomainResponse;

class VanityDomainCrudManagementTest extends ClientTestCase
{
    /**
     * @var VanityDomainResponse
     */
    private $vanityDomain1;
    /**
     * @var VanityDomainResponse
     */
    private $vanityDomain2;

    public function setUp()
    {
        parent::setUp();
        $this->vanityDomain1 = new VanityDomainResponse();
        $this->vanityDomain1->setId(1);
        $this->vanityDomain1->setStatus(1);
        $this->vanityDomain1->setNameservers([
            "ns-1234.awsdns-27.com.",
            "ns-1234.awsdns-27.com.",
            "ns-1234.awsdns-27.com.",
            "ns-1234.awsdns-27.com."
        ]);
        $this->vanityDomain1->setDomain("short.co.uk");
        $this->vanityDomain1->setHostedZoneId("/hostedzone/W3ZINZHDBUK27I");
        $this->vanityDomain2 = new VanityDomainResponse();
        $this->vanityDomain2->setId(2);
        $this->vanityDomain2->setStatus(0);
        $this->vanityDomain2->setNameservers([
            "ns-1234.awsdns-56.com.",
            "ns-1234.awsdns-56.com.",
            "ns-1234.awsdns-56.com.",
            "ns-1234.awsdns-56.com."
        ]);
        $this->vanityDomain2->setDomain("long.co.uk");
        $this->vanityDomain2->setHostedZoneId("/hostedzone/I72KUBDHZNIZ3W");

    }

    /** @test */
    public function getAllVanityDomains()
    {
        $expected = [$this->vanityDomain1, $this->vanityDomain2];

        $this->assertEquals($expected, $this->client->getAllVanityDomains());
    }
}