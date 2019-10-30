<?php

namespace Digitonic\PassonaClient\Facades\VanityDomains;

use Digitonic\PassonaClient\Entities\VanityDomains\Update;
use Illuminate\Support\Facades\Facade;

class UpdateVanityDomain extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Update::class;
    }
}
