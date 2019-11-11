<?php

namespace Digitonic\PassonaClient\Facades\Webhooks;

use Digitonic\PassonaClient\Entities\Webhooks\Index;
use Illuminate\Support\Facades\Facade;

class RetrieveWebhooks extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Index::class;
    }
}
