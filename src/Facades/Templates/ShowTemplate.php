<?php

namespace Digitonic\PassonaClient\Facades\Templates;

use Digitonic\PassonaClient\Entities\Templates\Show;
use Illuminate\Support\Facades\Facade;

class ShowTemplate extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Show::class;
    }
}
