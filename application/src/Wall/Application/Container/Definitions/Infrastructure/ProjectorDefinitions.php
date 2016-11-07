<?php

declare(strict_types=1);

namespace Wall\Application\Container\Definitions\Infrastructure;

use DeviceDetector\DeviceDetector;
use DI;
use Predis\Client as RedisClient;
use Psr\Http\Message\ServerRequestInterface;
use Wall\Application\Container\Definitions\Definitions;
use Wall\Application\Query\ClientStatisticsProjector;
use Wall\Application\Query\PublisherStatisticsProjector;
use Wall\Infrastructure\Query\Cache\RedisClientStatisticsProjector;
use Wall\Infrastructure\Query\Cache\RedisPublisherStatisticsProjector;

final class ProjectorDefinitions implements Definitions
{
    public static function get(): array
    {
        return [
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
