<?php

namespace LaravelPM\Mappers;

use LaravelPM\Models\ConversationInterface;
use LaravelPM\Models\MessageInterface;
use LaravelPM\Models\UserInterface;

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

    /**
     * Get user conversations
     *
     * @param UserInterface $user
     * @return ConversationInterface[]|array
     */
    public function getUserConversations(UserInterface $user);

    /**
     * Compose new conversation
     *
     * @param ConversationInterface $conversation
     * @return ConversationInterface|boolean
     */
    public function compose(ConversationInterface $conversation);
}
