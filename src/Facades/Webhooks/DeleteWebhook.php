<?php

namespace Digitonic\PassonaClient\Facades\Webhooks;

use Digitonic\PassonaClient\Entities\Webhooks\Delete;
use Illuminate\Support\Facades\Facade;

class DeleteWebhook extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Delete::class;
    }
}
