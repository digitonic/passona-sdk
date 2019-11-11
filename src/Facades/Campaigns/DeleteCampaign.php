<?php

namespace Digitonic\PassonaClient\Facades\Campaigns;

use Digitonic\PassonaClient\Entities\Campaigns\Delete;
use Illuminate\Support\Facades\Facade;

class DeleteCampaign extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Delete::class;
    }
}
