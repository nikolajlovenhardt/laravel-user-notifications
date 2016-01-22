# Usage

## Service

Example of how to use the `LaravelUserNotifications\Services\NotificationService`

Methods:
- `findByUser` Find all notifications for user
- `findUnreadByUser` Find all unread notifications for user
- `countUnreadByUser` Number of unread notifications for user
- `markRead` Mark specific notification as read
- `markAllRead` Mark all notifications for user as read
- `save` Save notification

### Dependency injection

The `NotificationService` can be injected using:

```php
/** @var \LaravelUserNotifications\Services\NotificationServiceInterface */
$notificationService = app(LaravelUserNotifications\Services\NotificationService::class);
```

```php
namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use LaravelUserNotifications\Services\NotificationService;
use LaravelUserNotifications\Services\NotificationServiceInterface;

class DemoController
{
    /** @var NotificationService */
    protected $notificationService;

    public function __construct(NotificationServiceInterface $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        $notificationService = $this->notificationService;

        /** @var User */
        $user = Auth::user();

        return view('demo.view', [
            'user' => $user,
            'unreadNotifications' => $notificationService->findUnreadByUser($user),
        ]);
    }
}
```

- Go back to [Eloquent](02 Eloquent.md)
- Go back to [Doctrine](02 Doctrine.md)