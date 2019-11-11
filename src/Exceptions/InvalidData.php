<?php

namespace Digitonic\PassonaClient\Exceptions;

use Exception;

class InvalidData extends Exception
{
    /**
     * @param string $message
     * @return static
     */
    public static function invalidValuesProvided(string $message)
    {
        return new static($message, 422);
    }
}
