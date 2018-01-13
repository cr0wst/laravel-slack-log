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
    public static $NONE = 0;
    public static $ERROR = 1;
    public static $WARN = 2;
    public static $INFO = 3;
    public static $TRACE = 4;
    public static $DEBUG = 5;
}
