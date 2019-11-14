<?php

namespace Digitonic\PassonaClient\Entities\Webhooks;

use Digitonic\PassonaClient\Requests\CollectionRequest;

class Index extends CollectionRequest
{
    const ENDPOINT = 'webhooks/';

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
