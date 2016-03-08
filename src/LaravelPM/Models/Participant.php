<?php

namespace LaravelPM\Models;

class Participant implements ParticipantInterface
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var ConversationInterface
     */
    protected $conversation;

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param UserInterface $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return ConversationInterface
     */
    public function getConversation()
    {
        return $this->conversation;
    }

    /**
     * @param ConversationInterface $conversation
     */
    public function setConversation($conversation)
    {
        $this->conversation = $conversation;
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
