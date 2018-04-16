<?php


namespace Tests\Feature;


use Digitonic\PassonaClient\Entities\VanityDomainResponse;

class VanityDomainCrudManagementTest extends ClientTestCase
{
    /** @test */
    public function getAllVanityDomains()
    {

        $vanityDomains = $this->client->getAllVanityDomains();
        $this->assertTrue(is_array($vanityDomains));

        if (isset($vanityDomains[0])){
            /** @var VanityDomainResponse vanityDomain */
            $vanityDomain = $this->client->getAllVanityDomains()[0];
            $this->assertTrue(in_array($vanityDomain->getStatus(), [0, 1]));
            $this->assertRegExp('#[A-Z0-9]{12}#', $vanityDomain->getHostedZoneId());
            $this->assertCount(4, $vanityDomain->getNameservers());

            foreach($vanityDomain->getNameservers() as $nameserver){
                $this->assertRegExp('#^([\w-]+).([\w-]+).([\w-]+).$#', $nameserver);
            }
            $this->assertRegExp('#^(?:\w+.)(\w+).(\w+)$#', $vanityDomain->getDomain());
        }
    }
}