<?php

declare(strict_types=1);

namespace Wall\Application\Container\Definitions\Infrastructure;

use DI;
use Predis\Client as RedisClient;
use Wall\Application\Container\Definitions\Definitions;
use Wall\Application\Query\ClientStatisticsQuery;
use Wall\Application\Query\PostsListQuery;
use Wall\Application\Query\PublisherStatisticsQuery;
use Wall\Infrastructure\Query\Cache\RedisClientStatisticsQuery;
use Wall\Infrastructure\Query\Cache\RedisPostsListQuery;
use Wall\Infrastructure\Query\Cache\RedisPublisherStatisticsQuery;

final class QueryDefinitions implements Definitions
{
    public static function get(): array
    {
        return [
            RedisClientStatisticsQuery::class => DI\object()
                ->constructor(DI\get(RedisClient::class)),
            RedisPublisherStatisticsQuery::class => DI\object()
                ->constructor(DI\get(RedisClient::class)),
            RedisPostsListQuery::class => DI\object()
                ->constructor(DI\get(RedisClient::class)),
            ClientStatisticsQuery::class    => DI\get(RedisClientStatisticsQuery::class),
            PublisherStatisticsQuery::class => DI\get(RedisPublisherStatisticsQuery::class),
            PublisherStatisticsQuery::class => DI\get(RedisPublisherStatisticsQuery::class),
            PostsListQuery::class           => DI\get(RedisPostsListQuery::class),
        ];
    }
}
