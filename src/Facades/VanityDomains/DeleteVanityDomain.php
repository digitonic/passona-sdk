<?php

namespace Digitonic\PassonaClient\Facades\VanityDomains;

use Digitonic\PassonaClient\Entities\VanityDomains\Delete;
use Illuminate\Support\Facades\Facade;

class DeleteVanityDomain extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Delete::class;
    }
}
