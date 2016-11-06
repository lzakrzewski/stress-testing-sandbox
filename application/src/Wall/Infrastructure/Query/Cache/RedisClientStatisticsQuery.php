<?php

declare(strict_types=1);

namespace Wall\Infrastructure\Query\Cache;

use Predis\Client as RedisClient;
use Wall\Application\Query\ClientStatisticsQuery;
use Wall\Application\Query\Result\ClientStatistics;

class RedisClientStatisticsQuery implements ClientStatisticsQuery
{
    /** @var RedisClient */
    private $redis;

    public function __construct(RedisClient $redis)
    {
        $this->redis = $redis;
    }

    public function get(): ClientStatistics
    {
        $mostOftenUsedBrowser = null;
        $mostOftenUsedOS      = null;

        $pipeline = $this->pipeline();

        if (!empty($pipeline[0][0])) {
            $mostOftenUsedBrowser = $pipeline[0][0];
        }

        if (!empty($pipeline[1][0])) {
            $mostOftenUsedOS = $pipeline[1][0];
        }

        return new ClientStatistics($mostOftenUsedBrowser, $mostOftenUsedOS);
    }

    private function pipeline(): array
    {
        $pipeline = $this->redis->pipeline();

        $pipeline->sort(
            'browsers',
            [
                'by'    => 'browser_*',
                'limit' => [0, 1],
                'sort'  => 'desc',
            ]
        );

        $pipeline->sort(
            'os',
            [
                'by'    => 'os_*',
                'limit' => [0, 1],
                'sort'  => 'desc',
            ]
        );

        return $pipeline->execute();
    }
}
