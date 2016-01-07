<?php

namespace LaravelUserNotificationsTest\Exceptions;

use LaravelUserNotifications\Exceptions\InvalidConfigurationException;
use PHPUnit_Framework_TestCase;
use stdClass;

class InvalidConfigurationExceptionTest extends PHPUnit_Framework_TestCase
{
    public function testException()
    {
        $this->setExpectedException(
            InvalidConfigurationException::class,
            'Please provide a valid configuration'
        );

        throw new InvalidConfigurationException();
    }
}