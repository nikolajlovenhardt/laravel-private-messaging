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

namespace LaravelPM;

use LaravelPM\Exceptions\InvalidMapperException;
use LaravelPM\Http\Controllers\PMController;
use LaravelPM\Mappers;
use LaravelPM\Mappers\MessageMapperInterface;
use LaravelPM\Options\ModuleOptions;
use LaravelPM\Services\PMService;
use LaravelPM\Services\EventService;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use LaravelPM\Exceptions\InvalidConfigurationException;
use LaravelPM\Services\PMServiceInterface;
use LaravelUserNotifications\Models\UserInterface;

class LaravelPMProvider extends ServiceProvider
{
    /**
     * Boot
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('private-messaging.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/pm'),
        ], 'views');

        $this->loadViewsFrom(
            __DIR__ . '/../../resources/views',
            'pm'
        );

        // Routes
        if (! $this->app->routesAreCached()) {
            require __DIR__ . '/Http/routes.php';
        }
    }

    /**
     * Register package
     */
    public function register()
    {
        $this->mergeConfig();

        // Laravel-doctrine support
        if (class_exists('\Doctrine\ORM\EntityManager')) {
            /** @var \Doctrine\ORM\EntityManager $entityManager */
            $entityManager = app('Doctrine\ORM\EntityManager');

            $xmlDriver = new \Doctrine\ORM\Mapping\Driver\XmlDriver(__DIR__ . '/../../config/doctrine/');

            /** @var \LaravelDoctrine\ORM\Extensions\MappingDriverChain $metaDriver */
            $metaDriver = $entityManager->getConfiguration()->getMetadataDriverImpl();
            $metaDriver->addDriver($xmlDriver, 'LaravelPM');
        }

        // Register services
        $this->registerServices();

        // Register services
        $this->registerControllers();
    }

    /**
     * Merge config
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/config.php',
            'private-messaging'
        );
    }

    /**
     * Register services
     */
    protected function registerServices()
    {
        // Notification service
        $this->app->bind(PMService::class, function (Application $app) {
            if (!$config = config('private-messaging')) {
                throw new InvalidConfigurationException();
            }

            $moduleOptions = new ModuleOptions($config);
            $mappers = $moduleOptions->get('mappers');

            // No message mapper
            if (!isset($mappers['messageMapper'])) {
                throw new InvalidMapperException(null, MessageMapperInterface::class);
            }

            /** @var MessageMapperInterface|null $messageMapper */
            $messageMapper = $app->make($mappers['messageMapper']);

            if (!$messageMapper instanceof MessageMapperInterface) {
                throw new InvalidMapperException($messageMapper, MessageMapperInterface::class);
            }

            /** @var EventService $eventService */
            $eventService = $app->make(EventService::class);

            return new PMService($eventService, $messageMapper);
        });

        // Doctrine mappers
        $this->app->bind(Mappers\DoctrineORM\MessageMapper::class, function (Application $app) {
            $objectManager = $app->make('Doctrine\ORM\EntityManager');
            return new Mappers\DoctrineORM\MessageMapper($objectManager);
        });

        $this->app->bind(Mappers\DoctrineORM\UserMapper::class, function (Application $app) {
            $objectManager = $app->make('Doctrine\ORM\EntityManager');
            return new Mappers\DoctrineORM\UserMapper($objectManager);
        });
    }

    /**
     * Register controllers
     */
    protected function registerControllers()
    {
        $this->app->bind(PMController::class, function (Application $app) {
            /** @var PMServiceInterface $pmService */
            $pmService = $app->make(PMService::class);

            return new PMController($pmService);
        });
    }
}