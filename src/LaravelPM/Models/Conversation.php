<?php

namespace LaravelPM\Models;

class Conversation implements ConversationInterface
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var ParticipantInterface[]|array
     */
    protected $participants;

    /**
     * @var MessageInterface[]|array
     */
    protected $messages;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var \DateTime
     */
    protected $updated;

    /**
     * @var \DateTime
     */
    protected $date;

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
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
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
     * @return array|ParticipantInterface[]
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * @param array|ParticipantInterface[] $participants
     */
    public function setParticipants($participants)
    {
        $this->participants = $participants;
    }

    /**
     * @return array|MessageInterface[]
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param array|MessageInterface[] $messages
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;
    }
}
