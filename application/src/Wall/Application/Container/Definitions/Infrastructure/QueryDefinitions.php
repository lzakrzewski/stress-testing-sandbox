<?php

declare(strict_types=1);

namespace Wall\Application\Container\Definitions\Infrastructure;

use DeviceDetector\DeviceDetector;
use DI;
use Doctrine\Common\Cache\PredisCache;
use Predis\Client as RedisClient;
use Psr\Http\Message\ServerRequestInterface;
use Wall\Application\Container\Definitions\Definitions;
use Wall\Application\Query\ClientStatisticsProjector;
use Wall\Application\Query\ClientStatisticsQuery;
use Wall\Application\Query\PublisherStatisticsProjector;
use Wall\Application\Query\PublisherStatisticsQuery;
use Wall\Infrastructure\Query\Cache\RedisClientStatisticsProjector;
use Wall\Infrastructure\Query\Cache\RedisClientStatisticsQuery;
use Wall\Infrastructure\Query\Cache\RedisPublisherStatisticsProjector;
use Wall\Infrastructure\Query\Cache\RedisPublisherStatisticsQuery;

final class QueryDefinitions implements Definitions
{
    public static function get(): array
    {
        return [
            DeviceDetector::class => DI\object()
                ->method('setCache', DI\get(PredisCache::class)),
            ClientStatisticsQuery::class             => DI\get(RedisClientStatisticsQuery::class),
            PublisherStatisticsQuery::class          => DI\get(RedisPublisherStatisticsQuery::class),
            PublisherStatisticsQuery::class          => DI\get(RedisPublisherStatisticsQuery::class),
            RedisPublisherStatisticsProjector::class => DI\object()
                ->constructor(DI\get(RedisClient::class)),
            RedisClientStatisticsProjector::class => DI\object()
                ->constructor(
                    DI\get(RedisClient::class),
                    DI\get(DeviceDetector::class),
                    DI\get(ServerRequestInterface::class)
                ),
            PublisherStatisticsProjector::class => DI\get(RedisPublisherStatisticsProjector::class),
            ClientStatisticsProjector::class    => DI\get(RedisClientStatisticsProjector::class),
        ];
    }
}
