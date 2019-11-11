<?php

namespace Digitonic\PassonaClient\Entities\VanityDomains;

use Digitonic\PassonaClient\Requests\BaseRequest;

class Index extends BaseRequest
{
    const ENDPOINT = 'vanity-domains/';

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
