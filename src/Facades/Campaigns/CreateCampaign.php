<?php

namespace Digitonic\PassonaClient\Facades\Campaigns;

use Digitonic\PassonaClient\Entities\Campaigns\Create;
use Illuminate\Support\Facades\Facade;

class CreateCampaign extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Create::class;
    }
}
