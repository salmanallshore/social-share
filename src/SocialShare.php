<?php

namespace Datumsquare\SocialShare;

use Illuminate\Support\Facades\Facade;

class SocialShare extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'socialshare'; }
}
