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
    public function getDate();

    /**
     * @return string
     */
    public function getTo();

    /**
     * @return string
     */
    public function getAuthor();
}
