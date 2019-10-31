<?php

namespace Digitonic\PassonaClient\Entities\Users;

use Digitonic\PassonaClient\Requests\BaseRequest;

class SyncGroups extends BaseRequest
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
