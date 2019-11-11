<?php

namespace Digitonic\PassonaClient\Facades\ContactGroups;

use Digitonic\PassonaClient\Entities\ContactGroups\Show;
use Illuminate\Support\Facades\Facade;

class ShowContactGroup extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Show::class;
    }
}
