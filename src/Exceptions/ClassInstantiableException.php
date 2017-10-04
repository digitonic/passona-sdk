<?php


namespace Digitonic\PassonaClient\Exceptions;


class ClassInstantiableException extends \Exception
{
    public function __construct()
    {
        $this->message = 'The template response class must be instantiable';
    }
}