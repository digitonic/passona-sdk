<?php

namespace Digitonic\PassonaClient\Entities\Keywords;

use Digitonic\PassonaClient\Requests\EntityRequest;

/**
 * Class Update
 * @package Digitonic\PassonaClient\Entities\Keywords
 * @method self setKeyword(string $keyword)
 * @method self setMessage(string $message)
 * @method self setHelp(string $help)
 * @method self setAddContactToGroup(bool $addContactToGroup)
 * @method self setCallWebhook(bool $callWebhook)
 * @method self setContactGroupsUuid(array $contactGroupsUuid)
 * @method self setWebhooksUuid(array $webhooksUuid)
 */
class Update extends EntityRequest
{
    const ENDPOINT = 'keywords/{keywordUuid}';

    protected $attributes = [
        'keyword',
        'message',
        'help',
        'add_contact_to_group',
        'call_webhook',
        'contact_groups_uuid',
        'webhooks_uuid',
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
