<?php

namespace LaravelPM\Helpers;

use LaravelPM\Mappers\UserMapperInterface;

class PMHelper
{
    /** @var UserMapper */
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
}
