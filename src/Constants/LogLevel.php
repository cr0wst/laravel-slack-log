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
    public const NONE = 0;
    public const ERROR = 1;
    public const WARN = 2;
    public const INFO = 3;
    public const TRACE = 4;
    public const DEBUG = 5;
}
