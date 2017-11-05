<?php

namespace Smcrow\SlackLog\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Smcrow\SlackLog\Messages\Log;
use Smcrow\SlackLog\Notifiables\Channel;

class LogMessageRequested extends Notification
{
    use Queueable;

    /**
     * @var Log $message
     */
    private $message;

    public function __construct(Log $message)
    {
        $this->message = $message;
    }

    public function via(): array
    {
        return ['slack'];
    }

    public function toSlack(Channel $notifiable): Log
    {
        return $this->message
            ->to($notifiable->getName())
            ->from(config('slack-log.nickname', 'SlackLog'));
    }
}
