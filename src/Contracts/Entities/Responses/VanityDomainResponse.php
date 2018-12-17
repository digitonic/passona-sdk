<?php

namespace Digitonic\PassonaClient\Contracts\Entities\Responses;

interface VanityDomainResponse
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param int $id
     */
    public function setId(int $id);

    /**
     * @return int
     */
    public function getStatus(): int;

    /**
     * @param int $status
     */
    public function setStatus(int $status);

    /**
     * @return array
     */
    public function getNameservers(): array;

    /**
     * @param array $nameservers
     */
    public function setNameservers(array $nameservers);

    /**
     * @return string
     */
    public function getDomain(): string;

    /**
     * @param string $domain
     */
    public function setDomain(string $domain);

    /**
     * @return string
     */
    public function getHostedZoneId(): string;

    /**
     * @param string $hostedZoneId
     */
    public function setHostedZoneId(string $hostedZoneId);
}
