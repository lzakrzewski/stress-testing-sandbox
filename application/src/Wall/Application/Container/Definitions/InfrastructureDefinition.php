<?php

declare(strict_types=1);

namespace Wall\Application\Container\Definitions;

use DI;
use DI\Container;
use Predis\Client as RedisClient;
use Wall\Application\Query\ClientStatisticsQuery;
use Wall\Application\Query\PublisherStatisticsQuery;
use Wall\Infrastructure\Persistence\Cache\RedisPostRepository;
use Wall\Infrastructure\Query\Cache\RedisClientStatisticsQuery;
use Wall\Infrastructure\Query\Cache\RedisPublisherStatisticsQuery;
use Wall\Model\PostRepository;

final class InfrastructureDefinition implements Definition
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
            RedisPostRepository::class => DI\object()
                ->constructor(DI\get(RedisClient::class)),
            RedisClientStatisticsQuery::class => DI\object()
                ->constructor(DI\get(RedisClient::class)),
            RedisPublisherStatisticsQuery::class => DI\object()
                ->constructor(DI\get(RedisClient::class)),
            PostRepository::class           => DI\get(RedisPostRepository::class),
            ClientStatisticsQuery::class    => DI\get(RedisClientStatisticsQuery::class),
            PublisherStatisticsQuery::class => DI\get(RedisPublisherStatisticsQuery::class),
        ];
    }
}
