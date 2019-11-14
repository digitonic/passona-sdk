<?php

namespace Digitonic\PassonaClient\Entities\Templates;

use Digitonic\PassonaClient\Requests\EntityRequest;

/**
 * Class Update
 * @package Digitonic\PassonaClient\Entities\Templates
 * @method self setName(string $name)
 * @method self setBody(string $body)
 * @method self setSender(string $nsender)
 */
class Update extends EntityRequest
{
    const ENDPOINT = 'templates/{templateUuid}';

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
        return true;
    }
}
