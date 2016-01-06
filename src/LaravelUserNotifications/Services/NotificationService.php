<?php

namespace LaravelUserNotifications\Services;

use LaravelUserNotifications\Mappers\NotificationMapperInterface;
use LaravelUserNotifications\Models\NotificationInterface;
use LaravelUserNotifications\Mappers\NotificationMapperInterface;

class NotificationService
{
    /** @var NotificationMapperInterface */
    protected $notificationMapper;

    public function __construct(NotificationMapperInterface $notificationMapper)
    {
        $this->notificationMapper = $notificationMapper;
    }

    /**
     * Save notification
     *
     * @param NotificationInterface $notification
     */
    public function save(NotificationInterface $notification)
    {
        // Save message
        $this->notificationMapper->save($notification);
    }
}
