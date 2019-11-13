<?php

namespace Digitonic\PassonaClient\Entities\ContactGroups;

use Digitonic\PassonaClient\Contracts\Passona;
use Digitonic\PassonaClient\Requests\EntityRequest;

/**
 * Class Create
 * @package Digitonic\PassonaClient\Entities\ContactGroups
 * @method self setName(string $name)
 * @method self setDescription(string $description)
 * @method self setDeletable(bool $deletable)
 */
class Create extends EntityRequest
{
    protected $attributes = ['name', 'description', 'deletable'];
    
    const ENDPOINT = 'contact-groups/';

    /**
     * Create constructor.
     * @param Passona $api
     */
    public function __construct(Passona $api)
    {
        parent::__construct($api);
    }

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
