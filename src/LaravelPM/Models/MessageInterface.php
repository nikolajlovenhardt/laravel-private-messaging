<?php

namespace LaravelPM\Models;

interface MessageInterface
{
    /**
     * Get message id
     *
     * @return string
     */
    public function getId();

    /**
     * Get date
     *
     * @return string
     */
    public function getDate();

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage();

    /**
     * Get user id
     *
     * @return string
     */
    public function getUser();

    /**
     * Get read status
     *
     * @return int
     */
    public function getRead();
}
