<?php

namespace Digitonic\PassonaClient\Entities\Senders;

use Digitonic\PassonaClient\Requests\EntityRequest;

/**
 * Class Create
 * @package Digitonic\PassonaClient\Entities\Senders
 * @method self setSender(string $sender)
 */
class Create extends EntityRequest
{
    const ENDPOINT = 'senders/';

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
        return false;
    }
}
