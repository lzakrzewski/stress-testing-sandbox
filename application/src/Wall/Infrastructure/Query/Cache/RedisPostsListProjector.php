<?php

declare(strict_types=1);

namespace Wall\Infrastructure\Query\Cache;

use Predis\Client as RedisClient;
use Wall\Application\Query\PostsListProjector;
use Wall\Model\PostWasPublished;

class RedisPostsListProjector implements PostsListProjector
{
    /** @var RedisClient */
    private $redis;

    public function __construct(RedisClient $redis)
    {
        $this->redis = $redis;
    }

    public function applyThatPostWasPublished(PostWasPublished $postWasPublished)
    {
        // TODO: Implement applyThatPostWasPublished() method.
    }
}
