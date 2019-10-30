<?php

namespace Digitonic\PassonaClient\Facades\VanityDomains;

use Digitonic\PassonaClient\Entities\VanityDomains\Create;
use Illuminate\Support\Facades\Facade;

class CreateVanityDomain extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Create::class;
    }
}
