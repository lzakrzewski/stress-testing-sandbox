<?php

declare(strict_types=1);

namespace Wall\Infrastructure\Query\Cache;

use Wall\Application\Query\ClientStatisticsQuery;
use Wall\Application\Query\Result\ClientStatistics;

class RedisClientStatisticsQuery implements ClientStatisticsQuery
{
    public function get(): ClientStatistics
    {
        return new ClientStatistics();
    }
}
