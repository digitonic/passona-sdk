<?php

namespace Digitonic\PassonaClient\Entities\Templates;

use Digitonic\PassonaClient\Requests\EntityRequest;

/**
 * Class Create
 * @package Digitonic\PassonaClient\Entities\Templates
 * @method self setName(string $name)
 * @method self setBody(string $body)
 * @method self setSender(string $nsender)
 */
class Create extends EntityRequest
{
    const ENDPOINT = 'templates/';

    protected $attributes = ['name', 'body', 'sender'];

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
