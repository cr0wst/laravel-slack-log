<?php

namespace Smcrow\SlackLog\Messages;

class Info extends Log
{
    public $level = 'info';

    protected function getLogTitle()
    {
        return 'Info Event';
    }
}
