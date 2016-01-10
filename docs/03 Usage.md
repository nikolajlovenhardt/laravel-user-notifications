# Usage

## Service

Example of how to use the `LaravelUserNotifications\NotificationService`

### Dependency injection

The `NotificationService` can be injected using:

```php
/** @var \LaravelUserNotifications\NotificationServiceInterface */
$notificationService = app(LaravelUserNotifications\NotificationService::class);
```

```php
namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use LaravelUserNotifications\NotificationService;
use LaravelUserNotifications\NotificationServiceInterface;

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

- Go back to (Eloquent)[02 Eloquent.md]
- Go back to (Doctrine)[02 Doctirne.md]