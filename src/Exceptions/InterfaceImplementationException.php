<?php


namespace Digitonic\PassonaClient\Exceptions;


class InterfaceImplementationException extends \Exception
{
    public function __construct(string $className)
    {
        $this->message = 'The template response class must be an implementation of '.$className;
    }
}