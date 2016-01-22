<?php

namespace LaravelUserNotificationsTest\Mappers\DoctrineORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use LaravelUserNotifications\Mappers\DoctrineORM\NotificationMapper;
use LaravelUserNotifications\Models\Notification;
use LaravelUserNotifications\Models\NotificationInterface;
use PHPUnit_Framework_TestCase;

class NotificationMapperTest extends PHPUnit_Framework_TestCase
{
    /** @var NotificationMapper */
    protected $mapper;

    /** @var ObjectManager */
    protected $objectManager;

    public function setUp()
    {
        /** @var ObjectManager $objectManager */
        $objectManager = $this->getMockBuilder(ObjectManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->objectManager = $objectManager;

        $this->mapper = new NotificationMapper($objectManager);
    }

    public function testFind()
    {
        $id = 'demoId';

        /** @var NotificationInterface $notification */
        $notification = $this->getMock(NotificationInterface::class);

        $this->objectManager->expects($this->at(0))
            ->method('find')
            ->with(Notification::class, $id)
            ->willReturn($notification);

        $result = $this->mapper->find($id);

        $this->assertSame(
            $notification,
            $result
        );
    }

    public function testFindByUser()
    {
        $userId = 'demoUserId';

        /** @var NotificationInterface $notification */
        $notification = $this->getMock(NotificationInterface::class);

        $notifications = [$notification];

        /** @var ObjectRepository $objectRepository */
        $objectRepository = $this->getMock(ObjectRepository::class);

        $this->objectManager->expects($this->at(0))
            ->method('getRepository')
            ->with(Notification::class)
            ->willReturn($objectRepository);

        $objectRepository->expects($this->at(0))
            ->method('findBy')
            ->with([
                'user' => $userId,
            ])
            ->willReturn($notifications);

        $result = $this->mapper->findByUser($userId);

        $this->assertSame(
            $notifications,
            $result
        );
    }

    public function testFindUnreadByUser()
    {
        $userId = 'demoUserId';

        /** @var NotificationInterface $notification */
        $notification = $this->getMock(NotificationInterface::class);

        $notifications = [$notification];

        /** @var ObjectRepository $objectRepository */
        $objectRepository = $this->getMock(ObjectRepository::class);

        $this->objectManager->expects($this->at(0))
            ->method('getRepository')
            ->with(Notification::class)
            ->willReturn($objectRepository);

        $objectRepository->expects($this->at(0))
            ->method('findBy')
            ->with([
                'user' => $userId,
                'read' => 0,
            ])
            ->willReturn($notifications);

        $result = $this->mapper->findUnreadByUser($userId);

        $this->assertSame(
            $notifications,
            $result
        );
    }

    public function testMarkRead()
    {
        /** @var NotificationInterface $notification */
        $notification = $this->getMockBuilder(NotificationInterface::class)
            ->setMethods([
                'getId',
                'getText',
                'getDate',
                'getUpdated',
                'setUpdated',
                'getUser',
                'getRead',
                'setRead',
            ])
            ->getMock();

        $notification->expects($this->at(0))
            ->method('setRead')
            ->with(true);

        $notification->expects($this->at(1))
            ->method('setUpdated');

        $this->objectManager->expects($this->at(0))
            ->method('persist')
            ->with($notification);

        $this->objectManager->expects($this->at(0))
            ->method('flush');

        $result = $this->mapper->markRead($notification);

        $this->assertTrue($result);
    }

    public function testSave()
    {
        /** @var NotificationInterface $notification */
        $notification = $this->getMockBuilder(NotificationInterface::class)
            ->setMethods([
                'getId',
                'getText',
                'getDate',
                'getUpdated',
                'setUpdated',
                'getUser',
                'getRead',
                'setRead',
            ])
            ->getMock();

        $notification->expects($this->at(0))
            ->method('setUpdated');

        $this->objectManager->expects($this->at(0))
            ->method('persist')
            ->with($notification);

        $this->objectManager->expects($this->at(0))
            ->method('flush');

        $result = $this->mapper->save($notification);

        $this->assertSame(
            $notification,
            $result
        );
    }

    public function testRemove()
    {
        /** @var NotificationInterface $notification */
        $notification = $this->getMock(NotificationInterface::class);

        $this->objectManager->expects($this->at(0))
            ->method('remove')
            ->with($notification);

        $this->objectManager->expects($this->at(0))
            ->method('flush');

        $result = $this->mapper->remove($notification);

        $this->assertTrue($result);
    }
}