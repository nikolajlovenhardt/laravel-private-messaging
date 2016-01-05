<?php

namespace LaravelPM\Services;

use LaravelPM\Mappers\MessageMapperInterface;
use LaravelPM\Models\MessageInterface;

class PMService
{
    /** @var MessageMapperInterface */
    protected $messageMapper;

    public function __construct(MessageMapperInterface $messageMapper)
    {
        $this->messageMapper = $messageMapper;
    }

    /**
     * Send message
     *
     * @param MessageInterface $message
     */
    public function send(MessageInterface $message)
    {
        // Save message
        $this->messageMapper->save($message);
    }
}
