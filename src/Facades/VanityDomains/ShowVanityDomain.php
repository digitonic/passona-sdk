<?php

namespace Digitonic\PassonaClient\Facades\VanityDomains;

use Digitonic\PassonaClient\Entities\VanityDomains\Show;
use Illuminate\Support\Facades\Facade;

class ShowVanityDomain extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Show::class;
    }
}
