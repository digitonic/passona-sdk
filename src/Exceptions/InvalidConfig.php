<?php


namespace Digitonic\PassonaClient\Exceptions;

use Exception;

class InvalidConfig extends Exception
{
    /**
     * @return static
     */
    public static function passonaApiKeyNotSpecified()
    {
        return new static('A valid Passona API key is required to access this data and no key was provided');
    }

    /**
     * @return static
     */
    public static function baseUrlNotSpecified()
    {
        return new static('You must provide a valid Base URL to query Passona');
    }

    /**
     * @return static
     */
    public static function noTeamUuidSpecified()
    {
        return new static('A valid team uuid is required and one was not provided');
    }
}
