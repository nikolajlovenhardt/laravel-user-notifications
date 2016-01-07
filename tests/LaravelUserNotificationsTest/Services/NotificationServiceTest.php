<?php

namespace LaravelUserNotificationsTest\Services;

use LaravelUserNotifications\Mappers\NotificationMapperInterface;
use LaravelUserNotifications\Models\NotificationInterface;
use LaravelUserNotifications\Models\UserInterface;
use LaravelUserNotifications\Services\EventService;
use LaravelUserNotifications\Services\NotificationService;
use PHPUnit_Framework_TestCase;

class NotificationServiceTest extends PHPUnit_Framework_TestCase
{
    /** @var NotificationService */
    protected $service;

    /** @var EventService */
    protected $eventService;

    /** @var NotificationMapperInterface */
    protected $notificationMapper;

    public function setUp()
    {
        /** @var EventService $eventService */
        $eventService = $this->getMock(EventService::class);
        $this->eventService = $eventService;

        /** @var NotificationMapperInterface $notificationMapper */
        $notificationMapper = $this->getMock(NotificationMapperInterface::class);
        $this->notificationMapper = $notificationMapper;

        $this->service = new NotificationService($eventService, $notificationMapper);
    }

    public function testFindByUser()
    {
        $notification = $this->getMock(NotificationInterface::class);

        $userId = 'demoId';

        /** @var UserInterface $user */
        $user = $this->getMock(UserInterface::class);

        $user->expects($this->at(0))
            ->method('getId')
            ->willReturn($userId);

        $this->notificationMapper->expects($this->at(0))
            ->method('findByUser')
            ->with($userId)
            ->willReturn($notification);

        $result = $this->service->findByUser($user);

        $this->assertSame(
            $notification,
            $result
        );
    }

    public function testFindUnreadByUser()
    {
        $notification = $this->getMock(NotificationInterface::class);

        $userId = 'demoId';

        /** @var UserInterface $user */
        $user = $this->getMock(UserInterface::class);

        $user->expects($this->at(0))
            ->method('getId')
            ->willReturn($userId);

        $this->notificationMapper->expects($this->at(0))
            ->method('findUnreadByUser')
            ->with($userId)
            ->willReturn($notification);

        $result = $this->service->findUnreadByUser($user);

        $this->assertSame(
            $notification,
            $result
        );
    }

    public function testCountUnreadByUser()
    {
        $notification = $this->getMock(NotificationInterface::class);
        $notifications = [$notification];

        $userId = 'demoId';

        /** @var UserInterface $user */
        $user = $this->getMock(UserInterface::class);

        $user->expects($this->at(0))
            ->method('getId')
            ->willReturn($userId);

        $this->notificationMapper->expects($this->at(0))
            ->method('findUnreadByUser')
            ->with($userId)
            ->willReturn($notifications);

        $result = $this->service->countUnreadByUser($user);

        $this->assertSame(
            count($notifications),
            $result
        );
    }

    public function testMarkRead()
    {
        /** @var NotificationInterface $notification */
        $notification = $this->getMock(NotificationInterface::class);

        $this->eventService->expects($this->at(0))
            ->method('fire')
            ->with(
                'user.notifications.markRead.pre',
                [
                'notification' => $notification,
                ]
            );

        $this->eventService->expects($this->at(1))
            ->method('fire')
            ->with(
                'user.notifications.markRead.post',
                [
                'notification' => $notification,
                ]
            );

        $this->notificationMapper->expects($this->at(0))
            ->method('markRead')
            ->with($notification)
            ->willReturn(true);

        $result = $this->service->markRead($notification);

        $this->assertTrue($result);
    }

    public function testSave()
    {
        /** @var NotificationInterface $notification */
        $notification = $this->getMock(NotificationInterface::class);

        $this->eventService->expects($this->at(0))
            ->method('fire')
            ->with(
                'user.notifications.save.pre',
                [
                'notification' => $notification,
                ]
            );

        $this->eventService->expects($this->at(1))
            ->method('fire')
            ->with(
                'user.notifications.save.post',
                [
                'notification' => $notification,
                ]
            );

        $this->notificationMapper->expects($this->at(0))
            ->method('save')
            ->with($notification)
            ->willReturn($notification);

        $result = $this->service->save($notification);

        $this->assertSame(
            $notification,
            $result
        );
    }
}