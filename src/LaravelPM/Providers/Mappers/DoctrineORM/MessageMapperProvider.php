<?php

namespace LaravelPM\Providers\Mappers\DoctrineORM;

use Illuminate\Support\ServiceProvider;
use LaravelPM\Mappers\DoctrineORM\MessageMapper;

class LaravelPMProvider extends ServiceProvider
{
    /**
     * Register mapper
     */
    public function register()
    {
        $this->app->bind(MessageMapper::class, function (Application $app) {
            /** @var \Doctrine\ORM\EntityManager $objectManager */
            $objectManager = $app->make('\Doctrine\ORM\EntityManager');

            return new MessageMapper($objectManager);
        });
    }
}