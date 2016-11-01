<?php

declare(strict_types=1);

namespace tests\integration\Wall\Application\Subscriber;

use tests\integration\Wall\Infrastructure\CacheTestCase;
use Wall\Model\PostWasPublished;

abstract class SubscriberTestCase extends CacheTestCase
{
    protected function handle(PostWasPublished $event)
    {
        $this->container()->get('event_bus')->handle($event);
    }
}
