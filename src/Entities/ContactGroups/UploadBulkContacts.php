<?php

namespace Digitonic\PassonaClient\Entities\ContactGroups;

use Digitonic\PassonaClient\Requests\EntityRequest;

/**
 * Class UploadBulkContacts
 * @package Digitonic\PassonaClient\Entities\ContactGroups
 * @method self setName(string $name)
 * @method self setDescription(string $description)
 * @method self setContacts(array $contacts)
 */
class UploadBulkContacts extends EntityRequest
{
    const ENDPOINT = 'contact-groups/bulk-contacts';

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
