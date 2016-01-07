<?php

namespace LaravelUserNotifications\Exceptions;

class InvalidMapperException extends Exception
{
    /**
     * Invalid mapper
     *
     * @param string $class
     * @param string $intendedClass
     */
    public function __construct($class, $intendedClass)
    {
        parent::__construct(sprintf(
            '%s must be an instance of %s',
            get_class($class),
            get_class($intendedClass)
        ));
    }
}
