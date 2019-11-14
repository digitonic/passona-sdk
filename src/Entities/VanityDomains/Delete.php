<?php

namespace Digitonic\PassonaClient\Entities\VanityDomains;

use Digitonic\PassonaClient\Requests\CollectionRequest;

class Delete extends CollectionRequest
{
    const ENDPOINT = 'vanity-domains/{vanityDomainUuid}';

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
        return true;
    }
}
