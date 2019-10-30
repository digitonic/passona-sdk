<?php

namespace Digitonic\PassonaClient\Entities\Links;

use Digitonic\PassonaClient\Requests\BaseRequest;

class Show extends BaseRequest
{
    const ENDPOINT = 'links/{linkUuid}';

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
