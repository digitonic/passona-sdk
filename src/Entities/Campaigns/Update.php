<?php

namespace Digitonic\PassonaClient\Entities\Campaigns;

use Digitonic\PassonaClient\Requests\BaseRequest;

class Update extends BaseRequest
{
    const ENDPOINT = 'campaigns/{campaignUuid}';

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
