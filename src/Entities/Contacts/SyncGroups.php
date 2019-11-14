<?php

namespace Digitonic\PassonaClient\Entities\Contacts;

use Digitonic\PassonaClient\Requests\CollectionRequest;

/**
 * Class SyncGroups
 * @package Digitonic\PassonaClient\Entities\Contacts
 * @method self setGroups(array $groups)
 * @method self setContact(string $contact)
 */
class SyncGroups extends CollectionRequest
{
    const ENDPOINT = 'contact/sync/groups';

    protected $attributes = [
        'groups',
        'contact'
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
