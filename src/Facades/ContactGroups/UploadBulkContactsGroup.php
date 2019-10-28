<?php

namespace Digitonic\PassonaClient\Facades\ContactGroups;

use Digitonic\PassonaClient\Entities\ContactGroups\UploadBulkContacts;
use Illuminate\Support\Facades\Facade;

class UploadBulkContactsGroup extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return UploadBulkContacts::class;
    }
}
