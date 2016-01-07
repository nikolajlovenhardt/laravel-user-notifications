<?php

namespace LaravelUserNotificationsTest\Exceptions;

use LaravelUserNotifications\Exceptions\InvalidMapperException;
use PHPUnit_Framework_TestCase;
use stdClass;

class InvalidMapperExceptionTest extends PHPUnit_Framework_TestCase
{
    public function testException()
    {
        $classOne = new stdClass();
        $classTwo = new stdClass();

        $this->setExpectedException(
            InvalidMapperException::class,
            sprintf(
                '%s must be an instance of %s',
                get_class($classOne),
                get_class($classTwo)
            )
        );

        throw new InvalidMapperException($classOne, $classTwo);
    }
}