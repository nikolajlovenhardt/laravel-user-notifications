<?php

namespace LaravelUserNotifications\Models;

interface NotificationInterface
{
    /**
     * Get notification id
     *
     * @return string
     */
    public function getId();

    /**
     * Get date
     *
     * @return string
     */
    public function getDate();

    /**
     * Get text
     *
     * @return string
     */
    public function getText();

    /**
     * Get user id
     *
     * @return string
     */
    public function getUser();
}
