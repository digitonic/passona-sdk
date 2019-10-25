<?php

namespace Digitonic\PassonaClient\Facades\ContactGroups;

use Digitonic\PassonaClient\Entities\ContactGroups\Update;
use Illuminate\Support\Facades\Facade;

class UpdateContactGroup extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Update::class;
    }
}
