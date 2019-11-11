<?php

namespace Digitonic\PassonaClient\Facades\Links;

use Digitonic\PassonaClient\Entities\Links\Delete;
use Illuminate\Support\Facades\Facade;

class DeleteLink extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Delete::class;
    }
}
