<?php

namespace Digitonic\PassonaClient\Entities\Senders;

use Digitonic\PassonaClient\Requests\BaseRequest;

class Create extends BaseRequest
{
    const ENDPOINT = 'senders/';

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
