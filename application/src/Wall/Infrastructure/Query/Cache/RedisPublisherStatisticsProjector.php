<?php

declare(strict_types=1);

namespace Wall\Infrastructure\Query\Cache;

use Predis\Client as RedisClient;
use Wall\Application\Query\PublisherStatisticsProjector;
use Wall\Model\PostWasPublished;

//Todo: refactor this
class RedisPublisherStatisticsProjector implements PublisherStatisticsProjector
{
    const PUBLISHERS_KEY        = 'publishers';
    const POSTS_KEY             = '_posts';
    const PUBLISHER_KEY_PATTERN = 'publisher_%s';

    /** @var RedisClient */
    private $redis;

    public function __construct(RedisClient $redis)
    {
        $this->redis = $redis;
    }

    public function applyThatPostWasPublished(PostWasPublished $event)
    {
        $publisherPostsCount = $this->publisherPostCount($event);

        $pipeline = $this->redis->pipeline();

        $pipeline->sadd(self::PUBLISHERS_KEY, $event->publisher());
        $pipeline->set($this->publisherKey($event), ++$publisherPostsCount);
        $pipeline->sadd(self::POSTS_KEY, $event->postId()->toString());

        $pipeline->execute();
    }

    private function publisherKey(PostWasPublished $event): string
    {
        return sprintf(self::PUBLISHER_KEY_PATTERN, $event->publisher());
    }

    private function publisherPostCount(PostWasPublished $event): int
    {
        $publisherPostsCount = $this->redis->get($this->publisherKey($event));

        if (null === $publisherPostsCount) {
            return 0;
        }

        return (int) $publisherPostsCount;
    }
}
