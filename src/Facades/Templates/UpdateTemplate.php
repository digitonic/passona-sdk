<?php

namespace Digitonic\PassonaClient\Facades\Templates;

use Digitonic\PassonaClient\Entities\Templates\Update;
use Illuminate\Support\Facades\Facade;

class UpdateTemplate extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Update::class;
    }
}
