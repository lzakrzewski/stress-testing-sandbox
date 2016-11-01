<?php

declare(strict_types=1);

namespace Wall\Infrastructure\Query\Cache;

use Wall\Application\Query\ClientStatisticsProjector;
use Wall\Model\PostWasPublished;

class RedisClientStatisticsProjector implements ClientStatisticsProjector
{
    public function applyThatPostWasPublished(PostWasPublished $event)
    {
    }
}
