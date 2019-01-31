<?php


namespace Digitonic\PassonaClient\Entities\Requests;

use Digitonic\PassonaClient\Contracts\Entities\Requests\LinkRequest as LinkRequestInterface;

class LinkRequest implements LinkRequestInterface
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $destination;
    /**
     * @var int
     */
    private $vanityDomainId;

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $destination
     */
    public function setDestination(string $destination)
    {
        $this->destination = $destination;
    }

    /**
     * @return string
     */
    public function getDestination(): string
    {
        return $this->destination;
    }

    /**
     * @param int $vanityDomainId
     */
    public function setVanityDomainId(int $vanityDomainId)
    {
        $this->vanityDomainId = $vanityDomainId;
    }

    /**
     * @return int
     */
    public function getVanityDomainId(): int
    {
        return $this->vanityDomainId;
    }
}
