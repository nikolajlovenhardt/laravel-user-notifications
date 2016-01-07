<?php

namespace LaravelUserNotifications\Services;

use LaravelUserNotifications\Models\UserInterface;
use LaravelUserNotifications\Models\NotificationInterface;
use LaravelUserNotifications\Mappers\NotificationMapperInterface;

interface NotificationServiceInterface
{
    public function __construct(EventService $eventService, NotificationMapperInterface $notificationMapper);

    /**
     * Find notifications
     *
     * @param UserInterface $user
     * @return array|\LaravelUserNotifications\Models\NotificationInterface[]
     */
    public function findByUser($user);

    /**
     * Find unread notifications
     *
     * @param UserInterface $user
     * @return array|\LaravelUserNotifications\Models\NotificationInterface[]
     */
    public function findUnreadByUser($user);

    /**
     * Number of unread notifications
     *
     * @param UserInterface $user
     * @return int
     */
    public function countUnreadByUser(UserInterface $user);

    /**
     * Mark notification as read
     *
     * @param NotificationInterface $notification
     * @return bool
     */
    public function markRead(NotificationInterface $notification);

    /**
     * Save notification
     *
     * @param NotificationInterface $notification
     * @return NotificationInterface
     */
    public function save(NotificationInterface $notification);
}
