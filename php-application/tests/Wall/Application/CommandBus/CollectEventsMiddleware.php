<?php

declare(strict_types=1);

namespace tests\Wall\Application\CommandBus;

use SimpleBus\Message\Bus\Middleware\MessageBusMiddleware;

class CollectEventsMiddleware implements MessageBusMiddleware
{
    /** @var array */
    private $events = [];

    public function handle($message, callable $next)
    {
        $this->events[] = $message;

        $next($message);
    }

    public function events(): array
    {
        return $this->events;
    }
}
