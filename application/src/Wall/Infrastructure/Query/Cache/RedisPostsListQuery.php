<?php

declare(strict_types=1);

namespace Wall\Infrastructure\Query\Cache;

use Predis\Client as RedisClient;
use Wall\Application\Query\PostsListQuery;

class RedisPostsListQuery implements PostsListQuery
{
    /** @var RedisClient */
    private $redis;

    public function __construct(RedisClient $redis)
    {
        $this->redis = $redis;
    }

    public function get(): array
    {
        return [];
    }
}
