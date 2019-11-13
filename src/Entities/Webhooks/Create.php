<?php

namespace Digitonic\PassonaClient\Entities\Webhooks;

use Digitonic\PassonaClient\Requests\EntityRequest;

/**
 * Class Create
 * @package Digitonic\PassonaClient\Entities\Webhooks
 * @method self setName(string $name)
 * @method self setUrl(string $url)
 * @method self setHeaders(array $headers)
 */
class Create extends EntityRequest
{
    const ENDPOINT = 'webhooks/';

    protected $attributes = [
        'name',
        'url',
        'headers',
    ];

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
