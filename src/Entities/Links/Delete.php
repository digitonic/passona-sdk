<?php

namespace Digitonic\PassonaClient\Entities\Links;

use Digitonic\PassonaClient\Requests\BaseRequest;

class Delete extends BaseRequest
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
