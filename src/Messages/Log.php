<?php

namespace Smcrow\SlackLog\Messages;

use Illuminate\Notifications\Messages\SlackAttachment;
use Illuminate\Notifications\Messages\SlackAttachmentField;
use Illuminate\Notifications\Messages\SlackMessage;

abstract class Log extends SlackMessage
{
    public static function message(string $body): Log
    {
        $instance = new static();
        return $instance
            ->attachment(function (SlackAttachment $attachment) use ($body, $instance) {
                $attachment->title($instance->getLogTitle())
                    ->field(function (SlackAttachmentField $field) use ($body) {
                        $field->content($body)->long();
                    })
                    ->footer('Current Log Level: ' . config('slack-log.log-level'));
            })
            ->linkNames();
    }

    abstract protected function getLogTitle();
}
