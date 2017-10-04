<?php


namespace Digitonic\PassonaClient\Entities;

use Digitonic\PassonaClient\Contracts\Entities\Responses\VanityDomainResponse;
use Digitonic\PassonaClient\Contracts\Entities\Responses\LinkResponse as LinkResponseInterface;

class LinkResponse implements LinkResponseInterface
{
    /**
     * @var int
     */
    private $id;
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
     * @var string
     */
    private $vanityDomainDomain;
    /**
     * @var bool
     */
    private $deleted;
    /**
     * @var VanityDomainResponse
     */
    private $vanityDomain;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

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
    public function getDestination(): string
    {
        return $this->destination;
    }

    /**
     * @param string $destination
     */
    public function setDestination(string $destination)
    {
        $this->destination = $destination;
    }

    /**
     * @return int
     */
    public function getVanityDomainId(): int
    {
        return $this->vanityDomainId;
    }

    /**
     * @param int $vanityDomainId
     */
    public function setVanityDomainId(int $vanityDomainId)
    {
        $this->vanityDomainId = $vanityDomainId;
    }

    /**
     * @return string
     */
    public function getVanityDomainDomain(): string
    {
        return $this->vanityDomainDomain;
    }

    /**
     * @param string $vanityDomainDomain
     */
    public function setVanityDomainDomain(string $vanityDomainDomain)
    {
        $this->vanityDomainDomain = $vanityDomainDomain;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * @param bool $deleted
     */
    public function setDeleted(bool $deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * @return VanityDomainResponse
     */
    public function getVanityDomain(): VanityDomainResponse
    {
        return $this->vanityDomain;
    }

    /**
     * @param VanityDomainResponse $vanityDomain
     */
    public function setVanityDomain(VanityDomainResponse $vanityDomain)
    {
        $this->vanityDomain = $vanityDomain;
    }
}