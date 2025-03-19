<?php

namespace Bishopm\Hub\Facades;

use Illuminate\Support\Facades\Facade;

class Hub extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'hub';
    }
}
