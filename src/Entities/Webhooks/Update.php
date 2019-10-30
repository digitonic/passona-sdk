<?php

namespace Digitonic\PassonaClient\Entities\Webhooks;

use Digitonic\PassonaClient\Requests\BaseRequest;

class Update extends BaseRequest
{
    const ENDPOINT = 'webhooks/{webhookUuid}';

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
