<?php

namespace Digitonic\PassonaClient\Facades\Keywords;

use Digitonic\PassonaClient\Entities\Keywords\Delete;
use Illuminate\Support\Facades\Facade;

class DeleteKeyword extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Delete::class;
    }
}
