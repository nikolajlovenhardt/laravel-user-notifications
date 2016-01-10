## Eloquent setup

Set the provider to `LaravelUserNotifications\Mappers\Eloquent\NotificationMapper` in `config/user-notifications.php`

`config/user-notifications.php`
```php
return [
    'notificationMapper' => LaravelUserNotifications\Mappers\Eloquent\NotificationMapper::class,
];
```

### Migrations

Run `php artisan vendor:publish --provider="LaravelUserNotifications\LaravelUserNotificationsProvider" --tag="migrations"` to publish migration

- Go back to [Getting started][01 Getting started.md)
- Continue to [Usage][03 Usage.md)