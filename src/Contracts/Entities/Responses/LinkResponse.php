<?php

namespace Digitonic\PassonaClient\Contracts\Entities\Responses;

interface LinkResponse
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
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getDestination(): string;

    /**
     * @param string $destination
     */
    public function setDestination(string $destination);

    /**
     * @return int
     */
    public function getVanityDomainId(): int;

    /**
     * @param int $vanityDomainId
     */
    public function setVanityDomainId(int $vanityDomainId);

    /**
     * @return string
     */
    public function getVanityDomainDomain(): string;

    /**
     * @param string $vanityDomainDomain
     */
    public function setVanityDomainDomain(string $vanityDomainDomain);

    /**
     * @return bool
     */
    public function isDeleted(): bool;

    /**
     * @param bool $deleted
     */
    public function setDeleted(bool $deleted);

    /**
     * @return VanityDomainResponse
     */
    public function getVanityDomain(): VanityDomainResponse;

    /**
     * @param VanityDomainResponse $vanityDomain
     */
    public function setVanityDomain(VanityDomainResponse $vanityDomain);
}
