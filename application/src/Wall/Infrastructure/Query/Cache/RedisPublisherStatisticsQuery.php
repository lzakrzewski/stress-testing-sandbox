<?php

declare(strict_types=1);

namespace Wall\Infrastructure\Query\Cache;

use Predis\Client as RedisClient;
use Wall\Application\Query\PublisherStatisticsQuery;
use Wall\Application\Query\Result\PublisherStatisticsResult;

class RedisPublisherStatisticsQuery implements PublisherStatisticsQuery
{
    /** @var RedisClient */
    private $redis;

    public function __construct(RedisClient $redis)
    {
        $this->redis = $redis;
    }

    public function get(): PublisherStatisticsResult
    {
        $mostActivePublisher = null;

        $pipeline = $this->pipeline();

        if (isset($pipeline[1][0]) && !empty($pipeline[1][0])) {
            $mostActivePublisher = $pipeline[1][0];
        }

        return new PublisherStatisticsResult($pipeline[0], $mostActivePublisher);
    }

    private function pipeline(): array
    {
        $pipeline = $this->redis->pipeline();

        $pipeline->scard('posts');
        $pipeline->sort(
            'publishers',
            [
                'by'    => 'publisher_*',
                'limit' => [0, 1],
                'sort'  => 'desc',
            ]
        );

        return $pipeline->execute();
    }
}
