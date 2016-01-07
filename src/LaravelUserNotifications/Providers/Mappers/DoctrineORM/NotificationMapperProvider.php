<?php

namespace LaravelUserNotifications\Providers\Mappers\DoctrineORM;

use Illuminate\Support\ServiceProvider;
use LaravelUserNotifications\Mappers\DoctrineORM\NotificationMapper;

class NotificationMapperProvider extends ServiceProvider
{
    /**
     * Register mapper
     */
    public function register()
    {
        $this->app->bind(NotificationMapper::class, function (Application $app) {
            /** @var \Doctrine\Common\Persistence\ObjectManager $objectManager */
            $objectManager = $app->make('\Doctrine\ORM\EntityManager');

            return new NotificationMapper($objectManager);
        });
    }
}