<?php

namespace Digitonic\PassonaClient\Facades\Webhooks;

use Digitonic\PassonaClient\Entities\Webhooks\Update;
use Illuminate\Support\Facades\Facade;

class UpdateWebhook extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Update::class;
    }
}
