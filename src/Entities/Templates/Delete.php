<?php

namespace Digitonic\PassonaClient\Entities\Templates;

use Digitonic\PassonaClient\Requests\BaseRequest;

class Delete extends BaseRequest
{
    const ENDPOINT = 'templates/{templateUuid}';

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
