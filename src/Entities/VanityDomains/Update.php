<?php

namespace Digitonic\PassonaClient\Entities\VanityDomains;

use Digitonic\PassonaClient\Requests\EntityRequest;

/**
 * Class Update
 * @package Digitonic\PassonaClient\Entities\VanityDomains
 * @method self setDomain(string $domain)
 */
class Update extends EntityRequest
{
    const ENDPOINT = 'vanity-domains/{vanityDomainUuid}';

    protected $attributes = ['domain'];
    
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
