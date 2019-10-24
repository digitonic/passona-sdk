<?php

namespace Digitonic\PassonaClient\Facades\Campaigns;

use Illuminate\Support\Facades\Facade;
use Digitonic\PassonaClient\Entities\Campaigns\Create as CreateCampaign;

class Create extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return CreateCampaign::class;
    }
}
