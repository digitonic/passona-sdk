<?php

namespace Digitonic\PassonaClient\Facades\Links;

use Digitonic\PassonaClient\Entities\Links\Show;
use Illuminate\Support\Facades\Facade;

class ShowLink extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Show::class;
    }
}
