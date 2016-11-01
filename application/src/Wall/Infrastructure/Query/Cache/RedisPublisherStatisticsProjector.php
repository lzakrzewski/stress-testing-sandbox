<?php

declare(strict_types=1);

namespace Wall\Infrastructure\Query\Cache;

use Predis\Client as RedisClient;
use Wall\Application\Query\PublisherStatisticsProjector;
use Wall\Model\PostWasPublished;

class RedisPublisherStatisticsProjector implements PublisherStatisticsProjector
{
    /** @var RedisClient */
    private $redis;

    public function __construct(RedisClient $redis)
    {
        $this->redis = $redis;
    }

    public function applyThatPostWasPublished(PostWasPublished $event)
    {
        $publisherPostsCount = $this->redis->get($this->publisherKey($event));

        if (empty($publisherPostsCount)) {
            $publisherPostsCount = 0;
        }

        $pipeline = $this->redis->pipeline();

        $pipeline->sadd('publishers', $event->publisher());
        $pipeline->set($this->publisherKey($event), ++$publisherPostsCount);
        $pipeline->sadd('posts', $event->postId()->toString());

        $pipeline->execute();
    }

    private function publisherKey(PostWasPublished $event): string
    {
        return sprintf('publisher_%s', $event->publisher());
    }
}
