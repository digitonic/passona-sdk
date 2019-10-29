<?php

namespace Digitonic\PassonaClient\Facades\Keywords;

use Digitonic\PassonaClient\Entities\Keywords\Show;
use Illuminate\Support\Facades\Facade;

class ShowKeyword extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Show::class;
    }
}
