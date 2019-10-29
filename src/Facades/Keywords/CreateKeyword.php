<?php

namespace Digitonic\PassonaClient\Facades\Keywords;

use Digitonic\PassonaClient\Entities\Keywords\Create;
use Illuminate\Support\Facades\Facade;

class CreateKeyword extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Create::class;
    }
}
