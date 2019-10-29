<?php

namespace Digitonic\PassonaClient\Facades\Senders;

use Digitonic\PassonaClient\Entities\Senders\Create;
use Illuminate\Support\Facades\Facade;

class CreateSender extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Create::class;
    }
}
