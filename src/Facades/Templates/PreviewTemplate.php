<?php

namespace Digitonic\PassonaClient\Facades\Templates;

use Digitonic\PassonaClient\Entities\Templates\Preview;
use Illuminate\Support\Facades\Facade;

class PreviewTemplate extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Preview::class;
    }
}
