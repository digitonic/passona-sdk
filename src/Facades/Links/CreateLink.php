<?php

namespace Digitonic\PassonaClient\Facades\Links;

use Digitonic\PassonaClient\Entities\Links\Create;
use Illuminate\Support\Facades\Facade;

class CreateLink extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Create::class;
    }
}
