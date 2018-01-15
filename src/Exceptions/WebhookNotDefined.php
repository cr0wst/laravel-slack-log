<?php

namespace Smcrow\SlackLog\Exceptions;

use Throwable;

class WebhookNotDefined extends \Exception
{
    public function __construct(
        $message = 'Webhook configuration value must be defined.',
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message);
    }
}
