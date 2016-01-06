<?php

namespace LaravelUserNotifications\Mappers\DoctrineORM;

use LaravelUserNotifications\Mappers\NotificationMapperInterface;
use LaravelUserNotifications\Models\NotificationInterface;
use LaravelUserNotifications\Mappers\NotificationMapperInterface;
use LaravelUserNotifications\Models\Notification;

class NotificationMapper implements NotificationMapperInterface
{
    protected $objectManager;

    public function __construct($objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Find notification from id
     *
     * @param string $id
     * @return NotificationInterface|null
     */
    public function find($id)
    {
        return $this->objectManager->find(Notification::class, $id);
    }

    /**
     * Save notification
     *
     * @param NotificationInterface $notification
     * @return NotificationInterface
     */
    public function save(NotificationInterface $notification)
    {
        $this->objectManager->persist($notification);
        $this->objectManager->flush();

        return $notification;
    }

    /**
     * Remove notification
     *
     * @param NotificationInterface $notification
     * @return bool
     */
    public function remove(NotificationInterface $notification)
    {
        $this->objectManager->remove($notification);
        $this->objectManager->flush();

        return true;
    }
}
