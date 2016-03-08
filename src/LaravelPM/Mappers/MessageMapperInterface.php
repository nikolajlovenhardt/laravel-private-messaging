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
     * Create new message
     *
     * @param string $message
     * @param UserInterface $user
     * @param ConversationInterface $conversation
     * @return MessageInterface
     */
    public function create($message, UserInterface $user, ConversationInterface $conversation);

    /**
     * Get user conversations
     *
     * @param UserInterface $user
     * @return ConversationInterface[]|array
     */
    public function getUserConversations(UserInterface $user);
}
