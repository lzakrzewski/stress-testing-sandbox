<?php

declare(strict_types=1);

namespace Wall\Infrastructure\Query\Cache;

use Wall\Application\Query\PublisherStatisticsQuery;
use Wall\Application\Query\Result\PublisherStatistics;

class RedisPublisherStatisticsQuery implements PublisherStatisticsQuery
{
    public function get(): PublisherStatistics
    {
        return new PublisherStatistics();
    }
}
