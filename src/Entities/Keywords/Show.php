<?php

namespace Digitonic\PassonaClient\Entities\Keywords;

use Digitonic\PassonaClient\Requests\BaseRequest;

class Show extends BaseRequest
{
    const ENDPOINT = 'keywords/{keywordUuid}';

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
