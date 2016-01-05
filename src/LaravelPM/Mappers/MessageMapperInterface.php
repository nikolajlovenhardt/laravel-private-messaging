<?php

namespace LaravelPM\Mappers;

use LaravelPM\Models\MessageInterface;

interface MessageMapperInterface
{
    /**
     * Find message from id
     *
     * @param string $id
     * @return MessageInterface|null
     */
    public function find($id);

    /**
     * Save message
     *
     * @param MessageInterface $message
     * @return MessageInterface
     */
    public function save(MessageInterface $message);

    /**
     * Remove message
     *
     * @param MessageInterface $message
     * @return boolean
     */
    public function remove(MessageInterface $message);
}
