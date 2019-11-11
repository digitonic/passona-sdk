<?php

namespace Digitonic\PassonaClient\Facades\Webhooks;

use Digitonic\PassonaClient\Entities\Webhooks\Show;
use Illuminate\Support\Facades\Facade;

class ShowWebhook extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Show::class;
    }
}
