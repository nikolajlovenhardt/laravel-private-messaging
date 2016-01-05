<?php

namespace LaravelPM\Providers\Mappers\DoctrineORM;

use Illuminate\Support\ServiceProvider;
use LaravelPM\Mappers\DoctrineORM\MessageMapper;
use LaravelPM\Mappers\MessageMapperInterface;
use LaravelPM\Options\Options;
use LaravelPM\Services\PMService;

class PMServiceProvider extends ServiceProvider
{
    /**
     * Register service
     */
    public function register()
    {
        $this->app->bind(PMService::class, function (Application $app) {
            $options = new Options(options('laravel-messaging'));
            $mappers = $options->get('mappers');

            /** @var MessageMapperInterface $messageMapper */
            $messageMapper = $app->make($mappers['messageMapper']);

            return new PMService($messageMapper);
        });
    }
}