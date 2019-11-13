<?php

namespace Digitonic\PassonaClient\Entities\Contacts;

use Digitonic\PassonaClient\Requests\EntityRequest;

class SwitchTeam extends EntityRequest
{
    const ENDPOINT = 'users/switch/team/{teamUuid}';

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
