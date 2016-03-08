<?php

namespace LaravelPM\Mappers;

use LaravelUserNotifications\Models\UserInterface;

interface UserMapperInterface
{
    /**
     * Find user

     * @param $id
     * @return UserInterface|null
     */
    public function find($id);

    /**
     * Find all users
     *
     * @return UserInterface[]|array
     */
    public function findAll();
}
