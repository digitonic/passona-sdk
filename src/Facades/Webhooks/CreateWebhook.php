<?php

namespace Digitonic\PassonaClient\Facades\Webhooks;

use Digitonic\PassonaClient\Entities\Webhooks\Create;
use Illuminate\Support\Facades\Facade;

class CreateWebhook extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Create::class;
    }
}
