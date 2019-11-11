<?php

namespace Digitonic\PassonaClient\Facades\Keywords;

use Digitonic\PassonaClient\Entities\Keywords\Index;
use Illuminate\Support\Facades\Facade;

class RetrieveKeywords extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Index::class;
    }
}
