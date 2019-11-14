<?php

namespace Digitonic\PassonaClient\Entities\ContactGroups;

use Digitonic\PassonaClient\Requests\EntityRequest;

/**
 * Class AddContacts
 * @package Digitonic\PassonaClient\Entities\ContactGroups
 * @method self setContacts(array $contacts)
 */
class AddContacts extends EntityRequest
{
    const ENDPOINT = 'contact-groups/{contactGroupUuid}/add-contacts';

    protected $attributes = ['contacts'];
    
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
