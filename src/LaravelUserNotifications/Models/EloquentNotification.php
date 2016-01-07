<?php

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
     * Get notification id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return new DateTime($this->date);
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Get user id
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
}
