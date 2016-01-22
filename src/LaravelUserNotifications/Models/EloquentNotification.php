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

namespace LaravelUserNotifications\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class EloquentNotification extends Model implements NotificationInterface
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'notifications';

    /**
     * Notificaiton ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Date
     *
     * @return string
     */
    public function getDate()
    {
        return new DateTime($this->date);
    }

    /**
     * Notificaiton text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * User ID
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Read
     *
     * @return int
     */
    public function getRead()
    {
        return $this->read;
    }

    /**
     * Updated
     *
     * @return string
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}
