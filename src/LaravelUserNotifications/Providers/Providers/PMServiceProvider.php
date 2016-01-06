<?php

namespace LaravelPM\Providers\Mappers\DoctrineORM;

use Illuminate\Support\ServiceProvider;
use LaravelUserNotifications\Mappers\NotificationMapperInterface;
use LaravelUserNotifications\Options\Options;
use LaravelUserNotifications\Services\NotificationService;

class PMServiceProvider extends ServiceProvider
{
    /**
     * Register service
     */
    public function register()
    {
        $this->app->bind(NotificationService::class, function (Application $app) {
            $options = new Options(options('user-notifications'));
            $mappers = $options->get('mappers');

            /** @var NotificationMapperInterface $notificationMapper */
            $notificationMapper = $app->make($mappers['notificationMapper']);

            return new NotificationService($notificationMapper);
        });
    }
}