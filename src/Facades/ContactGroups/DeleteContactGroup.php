<?php

namespace Digitonic\PassonaClient\Facades\ContactGroups;

use Digitonic\PassonaClient\Entities\ContactGroups\Delete;
use Illuminate\Support\Facades\Facade;

class DeleteContactGroup extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Delete::class;
    }
}
