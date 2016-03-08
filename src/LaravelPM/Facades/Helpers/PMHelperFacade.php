<?php

namespace LaravelPM\Facades\Helpers;

use LaravelPM\Helpers\PMHelper;
use Illuminate\Support\Facades\Facade;

class PMHelperFacade extends Facade
{
    /**
     * Name of the binding container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return PMHelper::class;
    }
}
