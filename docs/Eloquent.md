## Eloquent setup

### Migrations

Run `php artisan vendor:publish --provider="LaravelUserNotifications\LaravelUserNotificationsProvider" --tag="migrations"` to publish migration

### Mapper

Set the provider to `LaravelUserNotifications\Mappers\Eloquent\NotificationMapper`

`config/user-notifications.php`
```php
return [
    'notificationMapper' => LaravelUserNotifications\Mappers\Eloquent\NotificationMapper::class,
];
```