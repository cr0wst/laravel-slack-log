<?php

namespace Smcrow\SlackLog\Services;

use Smcrow\SlackLog\Constants\LogLevel;
use Smcrow\SlackLog\Messages\Debug;
use Smcrow\SlackLog\Messages\Error;
use Smcrow\SlackLog\Messages\Info;
use Smcrow\SlackLog\Messages\Log;
use Smcrow\SlackLog\Messages\Trace;
use Smcrow\SlackLog\Messages\Warn;
use Smcrow\SlackLog\Notifiables\Channel;
use Smcrow\SlackLog\Notifications\LogMessageRequested;

class Logger
{
    public function debug(string $message, $channelName = null): void
    {
        if ($this->isDebugEnabled()) {
            $this->log(Debug::message($message), $channelName);
        }
    }

    public function info(string $message, $channelName = null): void
    {
        if ($this->isInfoEnabled()) {
            $this->log(Info::message($message), $channelName);
        }
    }

    public function trace(string $message, $channelName = null): void
    {
        if ($this->isTraceEnabled()) {
            $this->log(Trace::message($message), $channelName);
        }
    }

    public function warn(string $message, $channelName = null): void
    {
        if ($this->isWarnEnabled()) {
            $this->log(Warn::message($message), $channelName);
        }
    }

    public function error(string $message, $channelName = null): void
    {
        if ($this->isErrorEnabled()) {
            $this->log(Error::message($message), $channelName);
        }
    }

    public function isDebugEnabled(): bool
    {
        return $this->isLogLevelEnabled(LogLevel::DEBUG);
    }

    public function isTraceEnabled(): bool
    {
        return $this->isLogLevelEnabled(LogLevel::TRACE);
    }

    public function isInfoEnabled(): bool
    {
        return $this->isLogLevelEnabled(LogLevel::INFO);
    }

    public function isWarnEnabled(): bool
    {
        return $this->isLogLevelEnabled(LogLevel::WARN);
    }

    public function isErrorEnabled(): bool
    {
        return $this->isLogLevelEnabled(LogLevel::ERROR);
    }

    private function isLogLevelEnabled(int $level): bool
    {
        return $level <= config('slack-log.log-level', LogLevel::NONE);
    }

    /**
     * Log the message to the slack channel.
     *
     * @param Log $message
     * @param string $channelName
     */
    protected function log(Log $message, string $channelName = null): void
    {
        (new Channel($channelName ?? config('slack-log.channel')))
            ->notify(new LogMessageRequested($message));
    }
}
