<?php

namespace Digitonic\PassonaClient\Facades\Senders;

use Digitonic\PassonaClient\Entities\Senders\Update;
use Illuminate\Support\Facades\Facade;

class UpdateSender extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Update::class;
    }
}
