<?php

namespace Digitonic\PassonaClient\Facades\Templates;

use Digitonic\PassonaClient\Entities\Templates\Delete;
use Illuminate\Support\Facades\Facade;

class DeleteTemplate extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Delete::class;
    }
}
