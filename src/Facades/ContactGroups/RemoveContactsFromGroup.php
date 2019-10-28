<?php

namespace Digitonic\PassonaClient\Facades\ContactGroups;

use Digitonic\PassonaClient\Entities\ContactGroups\RemoveContacts;
use Illuminate\Support\Facades\Facade;

class RemoveContactsFromGroup extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return RemoveContacts::class;
    }
}
