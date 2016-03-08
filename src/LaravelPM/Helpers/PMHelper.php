<?php

namespace LaravelPM\Helpers;

use LaravelPM\Mappers\UserMapperInterface;
use LaravelPM\Models\UserInterface;

class PMHelper
{
    /** @var UserMapperInterface */
    protected $userMapper;

    public function __construct(UserMapperInterface $userMapper)
    {
        $this->userMapper = $userMapper;
    }

    /**
     * Get user
     *
     * @param string $id
     * @return \LaravelPM\Models\UserInterface
     */
    public function user($id)
    {
        return $this->userMapper->find($id);
    }

    /**
     * Get current user
     *
     * @return UserInterface|null
     */
    public function currentUser()
    {
        return \Auth::user();
    }
}
