<?php

namespace Digitonic\PassonaClient\Facades\VanityDomains;

use Digitonic\PassonaClient\Entities\VanityDomains\Index;
use Illuminate\Support\Facades\Facade;

class RetrieveVanityDomains extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Index::class;
    }
}
