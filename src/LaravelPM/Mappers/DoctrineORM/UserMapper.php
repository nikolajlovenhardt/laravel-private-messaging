<?php

namespace LaravelPM\Mappers\DoctrineORM;

use LaravelPM\Mappers\UserMapperInterface;
use LaravelPM\Models\UserInterface;

class UserMapper implements UserMapperInterface
{
    protected $objectManager;

    /** @var UserInterface */
    protected $userModel;

    public function __construct($objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Find user
     *
     * @param string $id
     * @return UserInterface
     */
    public function find($id)
    {
        return $this->objectManager->find($this->userModel, $id);
    }

    /**
     * Find all users
     *
     * @return UserInterface[]|array
     */
    public function findAll()
    {
        return $this->objectManager->getRepository($this->userModel)->findAll();
    }
}
