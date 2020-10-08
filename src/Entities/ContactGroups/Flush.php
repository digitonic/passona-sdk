<?php

namespace Digitonic\PassonaClient\Entities\ContactGroups;

use Digitonic\PassonaClient\Exceptions\InvalidData;
use Digitonic\PassonaClient\Requests\EntityRequest;
use Illuminate\Support\Collection;

/**
 * Class Flush
 * @package Digitonic\PassonaClient\Entities\ContactGroups
 */
class Flush extends EntityRequest
{
    const ENDPOINT = 'contact-groups/{contactGroupUuid}/flush';

    protected $attributes = [];
    
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

    /**
     * @param string $entityIdentifier
     * @return Collection|\stdClass
     * @throws InvalidData
     */
    public function put(string $entityIdentifier)
    {
        $this->method = 'PUT';

        if ($this->requiresEntityUuid()) {
            $this->entityUuid = $entityIdentifier;
        }
        if ($this->entityUuid === '') {
            throw InvalidData::invalidValuesProvided('A valid entity UUID identifier is required for a PUT request');
        }

        return $this->send();
    }
}
