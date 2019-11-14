<?php

namespace Digitonic\PassonaClient\Entities\VanityDomains;

use Digitonic\PassonaClient\Requests\CollectionRequest;

class Index extends CollectionRequest
{
    const ENDPOINT = 'vanity-domains/';

    /**
     * @return string
     */
    protected function getFullEndpoint(): string
    {
        return self::ENDPOINT;
    }

    /**
     * @return bool
     */
    protected function requiresEntityUuid(): bool
    {
        return false;
    }
}
