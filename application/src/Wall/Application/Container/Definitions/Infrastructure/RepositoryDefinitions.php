<?php

declare(strict_types=1);

namespace Wall\Application\Container\Definitions\Infrastructure;

use DI;
use DI\Container;
use Doctrine\Common\Cache\PredisCache;
use Predis\Client as RedisClient;
use Wall\Application\Container\Definitions\Definitions;
use Wall\Infrastructure\Persistence\Cache\RedisPostRepository;
use Wall\Infrastructure\Query\Cache\RedisClientStatisticsQuery;
use Wall\Infrastructure\Query\Cache\RedisPublisherStatisticsQuery;
use Wall\Model\PostRepository;

final class RepositoryDefinitions implements Definitions
{
    public static function get(): array
    {
        return [
            RedisClient::class => function (Container $container) {
                return new RedisClient(
                    [
                        'host' => $container->get('parameters')['cache_host'],
                        'port' => $container->get('parameters')['cache_port'],
                    ]
                );
            },
            PredisCache::class => DI\object()
                ->constructor(DI\get(RedisClient::class)),
            RedisPostRepository::class => DI\object()
                ->constructor(DI\get(RedisClient::class)),
            RedisClientStatisticsQuery::class => DI\object()
                ->constructor(DI\get(RedisClient::class)),
            RedisPublisherStatisticsQuery::class => DI\object()
                ->constructor(DI\get(RedisClient::class)),
            PostRepository::class => DI\get(RedisPostRepository::class),
        ];
    }
}
