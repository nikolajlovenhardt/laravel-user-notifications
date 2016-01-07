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

use LaravelUserNotifications\Models\UserInterface;
use LaravelUserNotifications\Models\NotificationInterface;
use LaravelUserNotifications\Mappers\NotificationMapperInterface;

interface NotificationServiceInterface
{
    public function __construct(EventService $eventService, NotificationMapperInterface $notificationMapper);

    /**
     * Find notifications
     *
     * @param UserInterface $user
     * @return array|\LaravelUserNotifications\Models\NotificationInterface[]
     */
    public function findByUser($user);

    /**
     * Find unread notifications
     *
     * @param UserInterface $user
     * @return array|\LaravelUserNotifications\Models\NotificationInterface[]
     */
    public function findUnreadByUser($user);

    /**
     * Number of unread notifications
     *
     * @param UserInterface $user
     * @return int
     */
    public function countUnreadByUser(UserInterface $user);

    /**
     * Mark notification as read
     *
     * @param NotificationInterface $notification
     * @return bool
     */
    public function markRead(NotificationInterface $notification);

    /**
     * Save notification
     *
     * @param NotificationInterface $notification
     * @return NotificationInterface
     */
    public function save(NotificationInterface $notification);
}
