<?php

namespace Smcrow\SlackLog\Messages;

class Trace extends Log
{
    public $level = 'info';

    protected function getLogTitle()
    {
        return 'Trace Event';
    }
}
