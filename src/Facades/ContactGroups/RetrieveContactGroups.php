<?php

namespace Digitonic\PassonaClient\Facades\ContactGroups;

use Digitonic\PassonaClient\Entities\ContactGroups\Index;
use Illuminate\Support\Facades\Facade;

class RetrieveContactGroups extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Index::class;
    }
}
