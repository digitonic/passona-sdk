<?php

namespace Digitonic\PassonaClient\Entities\Senders;

use Digitonic\PassonaClient\Requests\EntityRequest;

class Show extends EntityRequest
{
    const ENDPOINT = 'senders/{senderUuid}';

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
