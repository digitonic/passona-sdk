<?php

namespace Digitonic\PassonaClient\Facades\Senders;

use Digitonic\PassonaClient\Entities\Senders\Show;
use Illuminate\Support\Facades\Facade;

class ShowSender extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Show::class;
    }
}
