<?php

namespace Digitonic\PassonaClient\Facades\Users;

use Digitonic\PassonaClient\Entities\Contacts\SyncGroups;
use Illuminate\Support\Facades\Facade;

class SyncContactToGroups extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return SyncGroups::class;
    }
}
