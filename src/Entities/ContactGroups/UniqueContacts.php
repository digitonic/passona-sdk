<?php

namespace Digitonic\PassonaClient\Entities\ContactGroups;

use Digitonic\PassonaClient\Requests\CollectionRequest;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Collection;

/**
 * Class UniqueContacts
 * @package Digitonic\PassonaClient\Entities\ContactGroups
 * @method self setIncludedContactGroupUuids(array $groupUuids)
 * @method self setExcludedContactGroupUuids(array $groupUuids)
 */
class UniqueContacts extends CollectionRequest
{
    const ENDPOINT = 'contact-groups/unique-contacts';

    protected $attributes = ['included_contact_group_uuids', 'excluded_contact_group_uuids'];

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

    /**
     * @return Collection|\stdClass
     */
    public function send(): Collection
    {
        $request = new Request($this->method, $this->buildEndpoint(), $this->headers, json_encode($this->payload));

        $response = $this->api->send($request);

        return collect(json_decode($response->getBody()->getContents())->data);
    }
}
