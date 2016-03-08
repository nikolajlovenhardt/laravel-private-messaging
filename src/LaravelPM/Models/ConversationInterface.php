<?php

namespace LaravelPM\Models;

interface ConversationInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getSubject();

    /**
     * @return \DateTime
     */
    public function getUpdated();

    /**
     * @return \DateTime
     */
    public function getDate();

    /**
     * @return Participant[]|array
     */
    public function getParticipants();

    /**
     * @return MessageInterface[]|array
     */
    public function getMessages();
}
