<?php

namespace LaravelPM\Mappers\DoctrineORM;

use Doctrine\Common\Persistence\ObjectManager;
use LaravelPM\Mappers\UserMapperInterface;
use LaravelPM\Models\UserInterface;

class UserMapper implements UserMapperInterface
{
    /** @var ObjectManager */
    protected $objectManager;

    protected $userModel;

    public function __construct($objectManager, $userModel)
    {
        $this->objectManager = $objectManager;
        $this->userModel = $userModel;
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
