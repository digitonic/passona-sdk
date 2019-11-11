<?php

namespace Digitonic\PassonaClient\Facades\Senders;

use Digitonic\PassonaClient\Entities\Senders\Delete;
use Illuminate\Support\Facades\Facade;

class DeleteSender extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Delete::class;
    }
}
