<?php
namespace Digitonic\PassonaClient\Facades;
use Digitonic\PassonaClient\Client;
use Illuminate\Support\Facades\Facade;

class PassonaClient extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Client::class;
    }
}