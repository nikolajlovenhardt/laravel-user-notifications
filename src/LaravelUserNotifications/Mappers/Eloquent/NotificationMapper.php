<?php

namespace LaravelUserNotifications\Mappers\Eloquent;

use LaravelUserNotifications\Mappers\NotificationMapperInterface;
use LaravelUserNotifications\Models\EloquentNotification;
use LaravelUserNotifications\Models\NotificationInterface;
use LaravelUserNotifications\Models\Notification;

class NotificationMapper implements NotificationMapperInterface
{
    /**
     * Find notification from id
     *
     * @param string $id
     * @return NotificationInterface|EloquentNotification|null
     */
    public function find($id)
    {
        return EloquentNotification::find($id);
    }

    /**
     * Find notifications by user
     *
     * @param string $userId
     * @return EloquentNotification[]|EloquentNotification[]|array
     */
    public function findByUser($userId)
    {
        return EloquentNotification::where('user', $userId)->all();
    }

    /**
     * Find unread notifications by user
     *
     * @param string $userId
     * @return NotificationInterface[]|array
     */
    public function findUnreadByUser($userId)
    {
        /** @var \Illuminate\Database\Eloquent\Collection $collection */
        $collection = EloquentNotification::where('user', '=', $userId)->get();
        return $collection->all();
    }

    /**
     * Mark notification as read
     *
     * @param NotificationInterface $notification
     * @return bool
     */
    public function markRead(NotificationInterface $notification)
    {
    }

    /**
     * Save notification
     *
     * @param NotificationInterface $notification
     * @return NotificationInterface
     */
    public function save(NotificationInterface $notification)
    {
    }

    /**
     * Remove notification
     *
     * @param NotificationInterface $notification
     * @return bool
     */
    public function remove(NotificationInterface $notification)
    {
    }
}
