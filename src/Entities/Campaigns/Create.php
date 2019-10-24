<?php

namespace Digitonic\PassonaClient\Entities\Campaigns;

use Digitonic\PassonaClient\Contracts\Passona;
use Digitonic\PassonaClient\Requests\BaseRequest;

class Create extends BaseRequest
{
    const ENDPOINT = 'campaigns/';

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
    protected function requiresTeamIdentifier(): bool
    {
        return false;
    }
}
