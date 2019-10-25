<?php

namespace Digitonic\PassonaClient\Entities\ContactGroups;

use Digitonic\PassonaClient\Contracts\Passona;
use Digitonic\PassonaClient\Requests\BaseRequest;

class Create extends BaseRequest
{
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
