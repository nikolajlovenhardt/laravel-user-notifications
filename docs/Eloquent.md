## Eloquent setup

Set the provider to `LaravelUserNotifications\Mappers\Eloquent\NotificationMapper`

`config/user-notifications.php`
```php
return [
    'notificationMapper' => LaravelUserNotifications\Mappers\DoctrineORM\EloquentMapper::class,
];
```