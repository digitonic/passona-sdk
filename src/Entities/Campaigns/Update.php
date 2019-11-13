<?php

namespace Digitonic\PassonaClient\Entities\Campaigns;

use Digitonic\PassonaClient\Requests\EntityRequest;

/**
 * Class Update
 * @package Digitonic\PassonaClient\Entities\Campaigns
 * @method self setName(string $name)
 * @method self setTemplateUuid(string $uuid)
 * @method self setSender(string $sender)
 * @method self setScheduledSendDate(string $datetimeString)
 * @method self setExpiryDate(string $datetimeString)
 * @method self setIncludedContactGroups(array $includedContactGroups)
 * @method self setExcludedContactGroups(array $excludedContactGroups)
 */
class Update extends EntityRequest
{
    const ENDPOINT = 'campaigns/{campaignUuid}';

    protected $attributes = [
        'template_uuid',
        'name',
        'sender',
        'scheduled_send_date',
        'expiry_date',
        'included_contact_groups',
        'excluded_contact_groups'
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
