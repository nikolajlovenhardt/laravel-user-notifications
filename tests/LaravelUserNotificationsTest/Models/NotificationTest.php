<?php

namespace LaravelUserNotificationsTest\Models;

use LaravelUserNotifications\Models\Notification;
use PHPUnit_Framework_TestCase;

class NotificationTest extends PHPUnit_Framework_TestCase
{
    /** @var Notification */
    protected $model;

    public function setUp()
    {
        $this->model = new Notification();
    }

    public function testId()
    {
        $id = 'uuid4';

        $this->model->setId($id);

        $this->assertSame(
            $id,
            $this->model->getId()
        );
    }

    public function testDate()
    {
        $date = new \DateTime();

        $this->model->setDate($date);

        $this->assertSame(
            $date,
            $this->model->getDate()
        );
    }

    public function testRead()
    {
        $read = true;

        $this->model->setRead($read);

        $this->assertSame(
            $read,
            $this->model->getRead()
        );
    }

    public function testText()
    {
        $text = 'demo text';

        $this->model->setText($text);

        $this->assertSame(
            $text,
            $this->model->getText()
        );
    }

    public function testUser()
    {
        $user = '1234';

        $this->model->setUser($user);

        $this->assertSame(
            $user,
            $this->model->getUser()
        );
    }
}