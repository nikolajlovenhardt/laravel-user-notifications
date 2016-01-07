<?php

namespace LaravelUserNotifications\Services;

use LaravelUserNotifications\Mappers\NotificationMapperInterface;
use LaravelUserNotifications\Models\NotificationInterface;
use LaravelUserNotifications\Models\UserInterface;

class NotificationService
{
    /** @var EventService */
    protected $eventService;

    /** @var NotificationMapperInterface */
    protected $notificationMapper;

    public function __construct(EventService $eventService, NotificationMapperInterface $notificationMapper)
    {
        $this->eventService = $eventService;
        $this->notificationMapper = $notificationMapper;
    }

    /**
     * Find notifications
     *
     * @param UserInterface $user
     * @return array|\LaravelUserNotifications\Models\NotificationInterface[]
     */
    public function findByUser(UserInterface $user)
    {
        return $this->notificationMapper->findByUser($user->getId());
    }

    /**
     * Find unread notifications
     *
     * @param UserInterface $user
     * @return array|\LaravelUserNotifications\Models\NotificationInterface[]
     */
    public function findUnreadByUser(UserInterface $user)
    {
        return $this->notificationMapper->findUnreadByUser($user->getId());
    }

    /**
     * Number of unread messages
     *
     * @param UserInterface $user
     * @return int
     */
    public function countUnreadByUser(UserInterface $user)
    {
        return count($this->findUnreadByUser($user));
    }

    /**
     * Mark notification as read
     *
     * @param NotificationInterface $notification
     * @return bool
     */
    public function markRead(NotificationInterface $notification)
    {
        $this->eventService->fire('user.notifications.markRead.pre', [
            'notification' => $notification,
        ]);

        $result =  $this->notificationMapper->markRead($notification);

        $this->eventService->fire('user.notifications.markRead.post', [
            'notification' => $notification,
        ]);

        return $result;
    }

    /**
     * Save notification
     *
     * @param NotificationInterface $notification
     * @return NotificationInterface
     */
    public function save(NotificationInterface $notification)
    {
        $this->eventService->fire('user.notifications.save.pre', [
            'notification' => $notification,
        ]);

        $result = $this->notificationMapper->save($notification);

        $this->eventService->fire('user.notifications.save.pre', [
            'notification' => $notification,
        ]);

        return $result;
    }
}
