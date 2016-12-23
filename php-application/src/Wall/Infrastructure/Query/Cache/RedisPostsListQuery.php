<?php

declare(strict_types=1);

namespace Wall\Infrastructure\Query\Cache;

use Predis\Client as RedisClient;
use Predis\Pipeline\Pipeline;
use Wall\Application\Query\PostsListQuery;
use Wall\Application\Query\Result\PostResult;

class RedisPostsListQuery implements PostsListQuery
{
    const RESULT_LIMIT = 1000;

    /** @var RedisClient */
    private $redis;

    public function __construct(RedisClient $redis)
    {
        $this->redis = $redis;
    }

    public function get(): array
    {
        $pipeline = $this->redis->pipeline();

        foreach ($this->redis->zrevrange(RedisPostsListProjector::POSTS_KEY, 0, self::RESULT_LIMIT - 1) as $key) {
            $pipeline->get($key);
        }

        return $this->mapResult($pipeline);
    }

    private function mapResult(Pipeline $pipeline): array
    {
        return array_map(function (string $content) {
            return $this->deserialize($content);
        }, $pipeline->execute());
    }

    private function deserialize(string $content): PostResult
    {
        $postData = json_decode($content, true);

        return new PostResult(
            $postData['postId'],
            $postData['publisher'],
            $postData['content'],
            new \DateTime($postData['at'])
        );
    }
}
