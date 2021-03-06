<?php

namespace LaravelPM\Models;

interface UserInterface
{
    /**
     * Get user id
     *
     * @return string
     */
    public function getId();

    /**
     * Get display name
     *
     * @return string
     */
    public function getDisplayName();
}
