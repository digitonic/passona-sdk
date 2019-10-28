<?php

namespace Digitonic\PassonaClient\Facades\ContactGroups;

use Digitonic\PassonaClient\Entities\ContactGroups\AddContacts;
use Illuminate\Support\Facades\Facade;

class AddContactsToGroup extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return AddContacts::class;
    }
}
