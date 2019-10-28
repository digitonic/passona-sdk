<?php

namespace Digitonic\PassonaClient\Facades\Templates;

use Digitonic\PassonaClient\Entities\Templates\Index;
use Illuminate\Support\Facades\Facade;

class RetrieveTemplates extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Index::class;
    }
}
