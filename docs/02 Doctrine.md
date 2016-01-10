## LaravelDoctrine setup

Set the provider to `LaravelUserNotifications\Mappers\DoctrineORM\NotificationMapper` in `config/user-notifications.php`

`config/user-notifications.php`
```php
return [
    'notificationMapper' => LaravelUserNotifications\Mappers\DoctrineORM\NotificationMapper::class,
];
```

## Relation

Add the notification relation in your User entity

### Example with annotations

This is an example with doctrine annotations

```php
<?php

namespace App\Entities;

use Rhumsaa\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use LaravelDoctrine\ORM\Auth\Authenticatable;
use Doctrine\Common\Collections\ArrayCollection;
use LaravelUserNotifications\Models\UserInterface;
use LaravelDoctrine\ORM\Contracts\Auth\Authenticatable as LaravelDoctrineAuthenticatable;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User implements LaravelDoctrineAuthenticatable, UserInterface
{
    use Authenticatable;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Id
     */
    protected $id;

    /**
     * @var \LaravelUserNotifications\Models\Notification[]|array
     *
     * @ORM\ManyToMany(targetEntity="LaravelUserNotifications\Models\Notification")
     * @ORM\JoinTable(name="user_notifications",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="notification_id", referencedColumnName="id", unique=true)}
     *      )
     */
    protected $notifications;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
        $this->notifications = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \LaravelUserNotifications\Models\Notification[]|array
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * @param \LaravelUserNotifications\Models\Notification[]|array $notifications
     */
    public function setNotifications($notifications)
    {
        $this->notifications = $notifications;
    }
}
```

- Go back to [Getting started](01 Getting started.md)
- Continue to [Usage](03 Usage.md)