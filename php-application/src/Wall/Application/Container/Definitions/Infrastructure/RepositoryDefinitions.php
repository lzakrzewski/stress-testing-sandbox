<?php

declare(strict_types=1);

namespace Wall\Application\Container\Definitions\Infrastructure;

use DeviceDetector\DeviceDetector;
use DI;
use DI\Container;
use Doctrine\Common\Cache\PredisCache;
use Predis\Client as RedisClient;
use Wall\Application\Container\Definitions\Definitions;
use Wall\Infrastructure\Persistence\EventBus\RecordedEventDispatchingPostRepository;
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
            DeviceDetector::class => DI\object()
                ->method('setCache', DI\get(PredisCache::class)),
            RecordedEventDispatchingPostRepository::class => DI\object()
                ->constructor(DI\get('event_bus')),
            PostRepository::class => DI\get(RecordedEventDispatchingPostRepository::class),
        ];
    }
}
