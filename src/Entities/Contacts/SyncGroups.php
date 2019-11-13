<?php

namespace Digitonic\PassonaClient\Entities\Users;

use Digitonic\PassonaClient\Requests\CollectionRequest;

class SyncGroups extends CollectionRequest
{
    const ENDPOINT = 'contact/sync/groups';

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
