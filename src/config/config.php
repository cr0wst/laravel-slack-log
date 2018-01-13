<?php
return [
    /**
     * The URL for the webhook.  For instructions on setting up webhook functionality see:
     * https://my.slack.com/services/new/incoming-webhook/
     */
    'webhook-url' => '',

    /**
     * The nickname for the logger to use.
     */
    'nickname' => 'SlackLog',

    /**
     * The log level.  This is an all inclusive value.  The following settings are valid.  You can use the LogLevel
     * constant or an integer value.  Setting a specific value will also enable the log levels below it.
     * - DEBUG  (5)
     * - TRACE  (4)
     * - INFO   (3)
     * - WARN   (2)
     * - ERROR  (1)
     * - NONE   (0)
     */
    'log-level' => \Smcrow\SlackLog\Constants\LogLevel::$DEBUG,

    /**
     * The channel to send log messages to.
     */
    'channel' => '',
];
