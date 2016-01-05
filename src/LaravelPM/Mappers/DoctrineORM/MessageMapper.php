<?php

namespace LaravelPM\Mappers\DoctrineORM;

use LaravelPM\Mappers\MessageMapperInterface;
use LaravelPM\Models\Message;
use LaravelPM\Models\MessageInterface;

class MessageMapper implements MessageMapperInterface
{
    protected $objectManager;

    public function __construct($objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Find message from id
     *
     * @param string $id
     * @return MessageInterface|null
     */
    public function find($id)
    {
        return $this->objectManager->find(Message::class, $id);
    }

    /**ActivityServiceProvider.php
     * Save message
     *
     * @param MessageInterface $message
     * @return MessageInterface
     */
    public function save(MessageInterface $message)
    {
        $this->objectManager->persist($message);
        $this->objectManager->flush();

        return $message;
    }

    /**
     * Remove message
     *
     * @param MessageInterface $message
     * @return bool
     */
    public function remove(MessageInterface $message)
    {
        $this->objectManager->remove($message);
        $this->objectManager->flush();

        return true;
    }
}
