<?php

namespace Digitonic\PassonaClient\Entities\ContactGroups;

use Digitonic\PassonaClient\Requests\EntityRequest;

/**
 * Class RemoveContacts
 * @package Digitonic\PassonaClient\Entities\ContactGroups
 * @method self setPhoneNumbers(array $phoneNumbers)
 */
class RemoveContacts extends EntityRequest
{
    const ENDPOINT = 'contact-groups/{contactGroupUuid}/remove-contacts';

    protected $attributes = ['phone_numbers'];
    
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
