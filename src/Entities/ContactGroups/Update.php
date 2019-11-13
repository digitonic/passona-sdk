<?php

namespace Digitonic\PassonaClient\Entities\ContactGroups;

use Digitonic\PassonaClient\Requests\EntityRequest;

/**
 * Class Update
 * @package Digitonic\PassonaClient\Entities\ContactGroups
 * @method self setName(string $name)
 * @method self setDescription(string $description)
 * @method self setContacts(array $contacts)
 */
class Update extends EntityRequest
{
    const ENDPOINT = 'contact-groups/{contactGroupUuid}';

    protected $attributes = [
        'name',
        'description' ,
        'contacts',
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
        return true;
    }
}
