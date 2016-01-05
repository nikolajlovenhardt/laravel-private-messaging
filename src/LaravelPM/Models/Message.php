<?php

namespace LaravelPM\Models;

class Message implements MessageInterface
{
    /**
     * @var string
     */
    protected $id;

    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}
