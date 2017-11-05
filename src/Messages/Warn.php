<?php

namespace Smcrow\SlackLog\Messages;

class Warn extends Log
{
    public $level = 'warning';

    protected function getLogTitle()
    {
        return 'Warn Event';
    }
}
