<?php

namespace Digitonic\PassonaClient\Entities\Links;

use Digitonic\PassonaClient\Requests\EntityRequest;

class Create extends EntityRequest
{
    const ENDPOINT = 'links/';

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
