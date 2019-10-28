<?php

namespace Digitonic\PassonaClient\Facades\Campaigns;

use Digitonic\PassonaClient\Entities\Campaigns\SendTest;
use Illuminate\Support\Facades\Facade;

class SendTestCampaign extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return SendTest::class;
    }
}
