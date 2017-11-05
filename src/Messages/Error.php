<?php

namespace Smcrow\SlackLog\Messages;

class Error extends Log
{
    public $level = 'error';

    protected function getLogTitle()
    {
        return 'Error Event';
    }
}
