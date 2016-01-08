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

namespace LaravelUserNotifications\Mappers\DoctrineORM;

use LaravelUserNotifications\Mappers\NotificationMapperInterface;
use LaravelUserNotifications\Models\NotificationInterface;
use LaravelUserNotifications\Models\Notification;

class NotificationMapper implements NotificationMapperInterface
{
    /** @var \Doctrine\Common\Persistence\ObjectManager */
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
