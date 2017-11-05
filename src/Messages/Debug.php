<?php

namespace Smcrow\SlackLog\Messages;

class Debug extends Log
{
    public $level = 'info';

    protected function getLogTitle()
    {
        return 'Debug Event';
    }
}
