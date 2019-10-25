<?php

namespace Digitonic\PassonaClient\Facades\Campaigns;

use Digitonic\PassonaClient\Entities\Campaigns\Update;
use Illuminate\Support\Facades\Facade;

class UpdateCampaign extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Update::class;
    }
}
