<?php

namespace LaravelUserNotifications\Mappers;

use LaravelUserNotifications\Models\NotificationInterface;

interface NotificationMapperInterface
{
    /**
     * Find notification from id
     *
     * @param string $id
     * @return NotificationInterface|null
     */
    public function find($id);

    /**
     * Find notifications by user
     *
     * @param string $userId
     * @return NotificationInterface[]|array
     */
    public function findByUser($userId);

    /**
     * Find unread notifications by user
     *
     * @param string $userId
     * @return NotificationInterface[]|array
     */
    public function findUnreadByUser($userId);

    /**
     * Mark notification as read
     *
     * @param NotificationInterface $notification
     * @return boolean
     */
    public function markRead(NotificationInterface $notification);

    /**
     * Save notification
     *
     * @param NotificationInterface $notification
     * @return NotificationInterface
     */
    public function save(NotificationInterface $notification);

    /**
     * Remove notification
     *
     * @param NotificationInterface $notification
     * @return boolean
     */
    public function remove(NotificationInterface $notification);
}
