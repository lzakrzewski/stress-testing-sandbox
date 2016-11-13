<?php

declare(strict_types=1);

namespace Wall\Infrastructure\Query\Cache;

use Predis\Client as RedisClient;
use Wall\Application\Query\PublisherStatisticsProjector;
use Wall\Model\PostWasPublished;

class RedisPublisherStatisticsProjector implements PublisherStatisticsProjector
{
    const PUBLISHERS_KEY = 'publishers';

    /** @var RedisClient */
    private $redis;

    public function __construct(RedisClient $redis)
    {
        $this->redis = $redis;
    }

    public function applyThatPostWasPublished(PostWasPublished $event)
    {
        $publisherRank = $this->publisherScore($event->publisher());

        $this->redis->zadd(self::PUBLISHERS_KEY, ++$publisherRank, $event->publisher());
    }

    private function publisherScore(string $publisher): int
    {
        $publisherRank = $this->redis->zscore(self::PUBLISHERS_KEY, $publisher);

        if (null === $publisherRank) {
            return 0;
        }

        return (int) $publisherRank;
    }
}
