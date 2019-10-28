<?php

namespace Digitonic\PassonaClient\Facades\Campaigns;

use Digitonic\PassonaClient\Entities\Campaigns\Index;
use Illuminate\Support\Facades\Facade;

class RetrieveCampaigns extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Index::class;
    }
}
