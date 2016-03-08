<?php

namespace LaravelPM\Models;

class Message implements MessageInterface
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @var ConversationInterface
     */
    protected $conversation;

    /**
     * @var string
     */
    protected $user;

    /**
     * @var int
     */
    protected $read;

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

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getRead()
    {
        return $this->read;
    }

    /**
     * @param int $read
     */
    public function setRead($read)
    {
        $this->read = $read;
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
}
