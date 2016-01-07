<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace LaravelUserNotifications;

use LaravelUserNotifications\Mappers;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use LaravelUserNotifications\Options\ModuleOptions;
use LaravelUserNotifications\Services\EventService;
use LaravelUserNotifications\Services\NotificationService;
use LaravelUserNotifications\Exceptions\InvalidMapperException;
use LaravelUserNotifications\Mappers\NotificationMapperInterface;
use LaravelUserNotifications\Exceptions\InvalidConfigurationException;

/**
 * Class LaravelUserNotificationsProvider
 * @package LaravelUserNotifications
 */
class LaravelUserNotificationsProvider extends ServiceProvider
{
    /**
     * Boot
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('user-notifications.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../../config/migrations/' => database_path('migrations')
        ], 'migrations');
    }

    /**
     * Register package
     */
    public function register()
    {
        $this->mergeConfig();

        if (class_exists('\Doctrine\ORM\EntityManager')) {
            /** @var \Doctrine\ORM\EntityManager $entityManager */
            $entityManager = app('Doctrine\ORM\EntityManager');

            $xmlDriver = new \Doctrine\ORM\Mapping\Driver\XmlDriver(__DIR__ . '/../../config/doctrine/');

            /** @var \LaravelDoctrine\ORM\Extensions\MappingDriverChain $metaDriver */
            $metaDriver = $entityManager->getConfiguration()->getMetadataDriverImpl();
            $metaDriver->addDriver($xmlDriver, 'LaravelUserNotifications');
        }

        // Register services
        $this->registerServices();
    }

    /**
     * Merge config
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/config.php',
            'user-notifications'
        );
    }

    /**
     * Register services
     */
    protected function registerServices()
    {
        // Notification service
        $this->app->bind(NotificationService::class, function (Application $app) {
            if (!$config = config('user-notifications')) {
                throw new InvalidConfigurationException();
            }

            $moduleOptions = new ModuleOptions($config);
            $mappers = $moduleOptions->get('mappers');

            /** @var NotificationMapperInterface|null $notificationMapper */
            $notificationMapper = $app->make($mappers['notificationMapper']);

            if (!$notificationMapper instanceof NotificationMapperInterface) {
                throw new InvalidMapperException($notificationMapper, NotificationMapperInterface::class);
            }

            /** @var EventService $eventService */
            $eventService = $app->make(EventService::class);

            return new NotificationService($eventService, $notificationMapper);
        });

        // Doctrine notification mapper
        $this->app->bind(Mappers\DoctrineORM\NotificationMapper::class, function (Application $app) {
            $objectManager = $app->make('Doctrine\ORM\EntityManager');
            return new Mappers\DoctrineORM\NotificationMapper($objectManager);
        });

    }
}