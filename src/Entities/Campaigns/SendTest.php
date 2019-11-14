<?php

namespace Digitonic\PassonaClient\Entities\Campaigns;

use Digitonic\PassonaClient\Requests\EntityRequest;

/**
 * Class SendTest
 * @package Digitonic\PassonaClient\Entities\Campaigns
 * @method self setName(string $name)
 * @method self setTemplateUuid(string $uuid)
 * @method self setSender(string $sender)
 * @method self setContactNumber(string $contactNumber)
 * @method self setCustomFields(array $customFields)
 * @method self setIncludedContactGroups(array $includedContactGroups)
 */
class SendTest extends EntityRequest
{
    const ENDPOINT = 'campaigns/send-test';

    protected $attributes = [
        'template_uuid',
        'name',
        'sender',
        'contact_number',
        'custom_fields',
        'included_contact_groups',
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
