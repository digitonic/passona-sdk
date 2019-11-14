<?php

namespace Digitonic\PassonaClient\Entities\Campaigns;

use Digitonic\PassonaClient\Requests\CollectionRequest;

class Index extends CollectionRequest
{
    const ENDPOINT = 'campaigns/';

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
