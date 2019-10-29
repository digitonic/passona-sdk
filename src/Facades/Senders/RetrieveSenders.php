<?php

namespace Digitonic\PassonaClient\Facades\Senders;

use Digitonic\PassonaClient\Entities\Senders\Index;
use Illuminate\Support\Facades\Facade;

class RetrieveSenders extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Index::class;
    }
}
