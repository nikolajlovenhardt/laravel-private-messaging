<?php

namespace LaravelPM\Mappers\DoctrineORM;

use LaravelPM\Mappers\UserMapperInterface;

class UserMapper implements UserMapperInterface
{
    protected $objectManager;

    public function __construct($objectManager)
    {
        $this->objectManager = $objectManager;
    }
}
