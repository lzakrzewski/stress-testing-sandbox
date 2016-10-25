<?php

declare(strict_types=1);

namespace Wall\Application\Container\Definitions;

use DI;
use DI\Container;
use Predis\Client as RedisClient;
use Wall\Infrastructure\Cache\RedisPostRepository;
use Wall\Infrastructure\InMemory\InMemoryPostRepository;
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
            InMemoryPostRepository::class => function () {
                return new InMemoryPostRepository();
            },
            PostRepository::class => function (Container $container) {
                return $container->get(InMemoryPostRepository::class);
            },
        ];
    }
}
