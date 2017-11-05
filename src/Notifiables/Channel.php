<?php

namespace Smcrow\SlackLog\Notifiables;

use Smcrow\SlackLog\Traits\CanRouteNotificationsToSlack;

class Channel
{
    use CanRouteNotificationsToSlack;

    /**
     * @var string $name
     */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
