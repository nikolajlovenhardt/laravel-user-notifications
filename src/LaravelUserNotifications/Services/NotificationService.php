<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace LaravelUserNotifications\Services;

use LaravelUserNotifications\Mappers\NotificationMapperInterface;
use LaravelUserNotifications\Models\NotificationInterface;
use LaravelUserNotifications\Models\UserInterface;

class NotificationService implements NotificationServiceInterface
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
    public function findByUser($user)
    {
        return $this->notificationMapper->findByUser($user->getId());
    }

    /**
     * Find unread notifications
     *
     * @param UserInterface $user
     * @return array|\LaravelUserNotifications\Models\NotificationInterface[]
     */
    public function findUnreadByUser($user)
    {
        return $this->notificationMapper->findUnreadByUser($user->getId());
    }

    /**
     * Number of unread notifications
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
     * Mark all notifications as read
     *
     * @param UserInterface $user
     * @return bool
     */
    public function markAllRead(UserInterface $user)
    {
        $this->eventService->fire('user.notifications.markAllRead.pre', [
            'user' => $user,
        ]);

        $result =  $this->notificationMapper->markAllRead($user->getId());

        $this->eventService->fire('user.notifications.markAllRead.post', [
            'user' => $user,
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

        $this->eventService->fire('user.notifications.save.post', [
            'notification' => $notification,
        ]);

        return $result;
    }
}
