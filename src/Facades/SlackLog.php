<?php

namespace Smcrow\SlackLog\Facades;

use Illuminate\Support\Facades\Facade;
use Smcrow\SlackLog\Services\Logger;

class SlackLog extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Logger::class;
    }
}