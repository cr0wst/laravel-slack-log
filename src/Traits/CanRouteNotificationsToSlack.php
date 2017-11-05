<?php

namespace Smcrow\SlackLog\Traits;

use Illuminate\Notifications\Notifiable;

trait CanRouteNotificationsToSlack
{
    use Notifiable;

    public function routeNotificationForSlack(): string
    {
        return config('slack-log.webhook-url');
    }
}
