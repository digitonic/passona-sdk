<?php

namespace Digitonic\PassonaClient\Facades\Keywords;

use Digitonic\PassonaClient\Entities\Keywords\Update;
use Illuminate\Support\Facades\Facade;

class UpdateKeyword extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Update::class;
    }
}
