<?php

namespace Smcrow\SlackLog\Constants;

class LogLevel
{
    /**
     * The various log levels for the application.  Setting a level will allow all lower levels to become enabled.
     *
     * Example: A log level of 0 will disable logging entirely, while a log level of 2 will enable ERROR, WARN,
     * and TRACE.
     */
    const NONE = 0;
    const ERROR = 1;
    const WARN = 2;
    const INFO = 3;
    const TRACE = 4;
    const DEBUG = 5;
}
