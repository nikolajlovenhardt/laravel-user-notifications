<?php

namespace LaravelUserNotifications\Exceptions;

class InvalidConfigurationException extends Exception
{
    /**
     * Invalid configuration
     */
    public function __construct()
    {
        parent::__construct('Please provide a valid configuration');
    }
}
