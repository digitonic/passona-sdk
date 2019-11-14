<?php

namespace Digitonic\PassonaClient\Entities\Senders;

use Digitonic\PassonaClient\Requests\EntityRequest;

/**
 * Class Update
 * @package Digitonic\PassonaClient\Entities\Senders
 * @method self setSender(string $sender)
 */
class Update extends EntityRequest
{
    const ENDPOINT = 'senders/{senderUuid}';

    protected $attributes = ['sender'];
    
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
