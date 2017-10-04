<?php

namespace Digitonic\PassonaClient\Contracts\Entities\Requests;

interface LinkRequest
{
    /**
     * @param string $name
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $destination
     */
    public function setDestination(string $destination);

    /**
     * @return string
     */
    public function getDestination(): string;

    /**
     * @param int $vanityDomainId
     */
    public function setVanityDomainId(int $vanityDomainId);

    /**
     * @return int
     */
    public function getVanityDomainId(): int;
}