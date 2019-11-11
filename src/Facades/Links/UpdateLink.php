<?php

namespace Digitonic\PassonaClient\Facades\Links;

use Digitonic\PassonaClient\Entities\Links\Update;
use Illuminate\Support\Facades\Facade;

class UpdateLink extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Update::class;
    }
}
