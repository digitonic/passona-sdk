<?php

namespace Digitonic\PassonaClient\Facades\Users;

use Illuminate\Support\Facades\Facade;

class SwitchTeam extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return \Digitonic\PassonaClient\Entities\Users\SwitchTeam::class;
    }
}
