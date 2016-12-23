<?php

declare(strict_types=1);

namespace Wall\Infrastructure\Query\Cache;

use Predis\Client as RedisClient;
use Wall\Application\Query\PostsListProjector;
use Wall\Model\PostWasPublished;

class RedisPostsListProjector implements PostsListProjector
{
    const POSTS_KEY        = 'posts';
    const POST_KEY_PATTERN = 'post:%s';

    /** @var RedisClient */
    private $redis;

    public function __construct(RedisClient $redis)
    {
        $this->redis = $redis;
    }

    public function applyThatPostWasPublished(PostWasPublished $event)
    {
        $pipeline = $this->redis->pipeline();

        $pipeline->zadd(self::POSTS_KEY, $event->at()->getTimestamp(), $this->key($event))
            ->set($this->key($event), $this->serialize($event))
            ->execute();
    }

    private function serialize(PostWasPublished $event): string
    {
        return json_encode([
            'postId'    => $event->postId()->toString(),
            'publisher' => $event->publisher(),
            'content'   => $event->content(),
            'at'        => $event->at()->format('Y-m-d H:i:s'),
        ]);
    }

    private function key(PostWasPublished $event): string
    {
        return sprintf(self::POST_KEY_PATTERN, $event->postId()->toString());
    }
}
