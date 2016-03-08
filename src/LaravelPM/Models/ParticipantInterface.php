<?php

namespace LaravelPM\Models;

interface ParticipantInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return ConversationInterface
     */
    public function getConversation();

    /**
     * @return UserInterface
     */
    public function getUser();
}
