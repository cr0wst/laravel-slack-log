<?php
/**
 * Created by PhpStorm.
 * User: smcro
 * Date: 11/5/2017
 * Time: 1:29 PM
 */

namespace Smcrow\SlackLog\Exceptions;


use Throwable;

class WebhookNotDefined extends \Exception
{
    public function __construct($message = 'Webhook configuration value must be defined.', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message);
    }
}