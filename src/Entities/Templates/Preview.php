<?php

namespace Digitonic\PassonaClient\Entities\Templates;

use Digitonic\PassonaClient\Requests\EntityRequest;

class Preview extends EntityRequest
{
    const ENDPOINT = 'templates/{templateUuid}/preview';

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
