<?php

namespace Digitonic\PassonaClient\Entities\Senders;

use Digitonic\PassonaClient\Requests\BaseRequest;

class Update extends BaseRequest
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
