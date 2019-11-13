<?php

namespace Digitonic\PassonaClient\Entities\Links;

use Digitonic\PassonaClient\Requests\EntityRequest;

/**
 * Class Create
 * @package Digitonic\PassonaClient\Entities\Links
 * @method self setVanityDomainUuid(string $vanityDomainUuid)
 * @method self setTemplateUuid(string $templateUuid)
 * @method self setName(string $name)
 * @method self setDestination(string $destination)
 */
class Create extends EntityRequest
{
    const ENDPOINT = 'links/';

    protected $attributes = [
        'vanity_domain_uuid',
        'template_uuid',
        'name',
        'destination'
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
