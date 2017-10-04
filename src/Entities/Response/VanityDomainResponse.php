<?php


namespace Digitonic\PassonaClient\Entities;


use Digitonic\PassonaClient\Contracts\Entities\Responses\VanityDomainResponse as VanityDomainResponseInterface;

class VanityDomainResponse implements VanityDomainResponseInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $status;

    /**
     * @var array
     */
    private $nameservers;

    /**
     * @var string
     */
    private $domain;

    /**
     * @var string
     */
    private $hostedZoneId;

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
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    /**
     * @return array
     */
    public function getNameservers(): array
    {
        return $this->nameservers;
    }

    /**
     * @param array $nameservers
     */
    public function setNameservers(array $nameservers)
    {
        $this->nameservers = $nameservers;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     */
    public function setDomain(string $domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return string
     */
    public function getHostedZoneId(): string
    {
        return $this->hostedZoneId;
    }

    /**
     * @param string $hostedZoneId
     */
    public function setHostedZoneId(string $hostedZoneId)
    {
        $this->hostedZoneId = $hostedZoneId;
    }
}