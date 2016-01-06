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
