<?php

namespace LaravelUserNotifications\Options;

class ModuleOptions extends Options
{
    /** @var array */
    protected $defaults = [
        'mappers' => [
            'notificationMapper' => null,
        ],
    ];
}
