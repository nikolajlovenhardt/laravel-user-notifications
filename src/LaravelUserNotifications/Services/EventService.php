<?php

namespace LaravelUserNotifications\Services;

use Event;
use stdClass;

class EventService
{
    /**
     * @param stdClass|string $event
     * @param array|string|stdClass|null $data
     * @return boolean
     */
    public function fire($event, $data = null)
    {
        return Event::fire($event, $data);
    }
}
