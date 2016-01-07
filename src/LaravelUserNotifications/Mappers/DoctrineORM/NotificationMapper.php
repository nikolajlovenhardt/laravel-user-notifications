<?php

namespace LaravelUserNotifications\Mappers\DoctrineORM;

use LaravelUserNotifications\Mappers\NotificationMapperInterface;
use LaravelUserNotifications\Models\NotificationInterface;
use LaravelUserNotifications\Models\Notification;

class NotificationMapper implements NotificationMapperInterface
{
    /** @var \Doctrine\Common\ */
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
     * Find notifications by user
     *
     * @param string $userId
     * @return NotificationInterface[]|array
     */
    public function findByUser($userId)
    {
        return $this->objectManager->getRepository(Notification::class)->findBy([
            'user' => $userId,
        ]);
    }

    /**
     * Find unread notifications by user
     *
     * @param string $userId
     * @return NotificationInterface[]|array
     */
    public function findUnreadByUser($userId)
    {
        return $this->objectManager->getRepository(Notification::class)->findBy([
            'user' => $userId,
            'read' => 0,
        ]);
    }

    /**
     * Mark notification as read
     *
     * @param NotificationInterface $notification
     * @return bool
     */
    public function markRead(NotificationInterface $notification)
    {
        $notification->setRead(true);
        $this->save($notification);

        return true;
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
