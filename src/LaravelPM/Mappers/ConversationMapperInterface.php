<?php

namespace LaravelPM\Mappers;

use LaravelPM\Models\ConversationInterface;

interface ConversationMapperInterface
{
    /**
     * Find conversation from id
     *
     * @param string $id
     * @return ConversationInterface|null
     */
    public function find($id);

    /**
     * Save conversation
     *
     * @param ConversationInterface $conversation
     * @return ConversationInterface
     */
    public function save(ConversationInterface $conversation);

    /**
     * Remove conversation
     *
     * @param ConversationInterface $conversation
     * @return boolean
     */
    public function remove(ConversationInterface $conversation);
}
