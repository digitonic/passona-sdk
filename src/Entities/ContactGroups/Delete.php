<?php

namespace Digitonic\PassonaClient\Entities\ContactGroups;

use Digitonic\PassonaClient\Requests\CollectionRequest;

class Delete extends CollectionRequest
{
    const ENDPOINT = 'contact-groups/{contactGroupUuid}';

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
