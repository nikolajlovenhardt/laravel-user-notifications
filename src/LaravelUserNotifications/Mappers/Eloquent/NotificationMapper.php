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
        $notification->read = 1;
        $this->save($notification);

        return true;
    }

    /**
     * Mark all notifications as read
     *
     * @param string $userId
     * @return bool
     */
    public function markAllRead($userId)
    {
        $notifications = $this->findUnreadByUser($userId);

        foreach ($notifications as $notification) {
            $notification->read = 1;
            $this->save($notification);
        }

        return true;
    }

    /**
     * Save notification
     *
     * @param EloquentNotification|NotificationInterface $notification
     * @return NotificationInterface
     */
    public function save(NotificationInterface $notification)
    {
        $notification->save();

        return $notification;
    }

    /**
     * Remove notification
     *
     * @param EloquentNotification|NotificationInterface $notification
     * @return bool
     */
    public function remove(NotificationInterface $notification)
    {
        $notification->delete();

        return true;
    }
}
