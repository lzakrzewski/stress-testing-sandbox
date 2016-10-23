<?php

declare(strict_types=1);

namespace Wall\Application\Container\Definitions;

use DI\Container;
use Wall\Infrastructure\InMemory\InMemoryPostRepository;
use Wall\Model\PostRepository;

final class InfrastructureDefinition implements Definition
{
    public static function get(): array
    {
        return [
            InMemoryPostRepository::class => function () {
                return new InMemoryPostRepository();
            },
            PostRepository::class => function (Container $container) {
                return $container->get(InMemoryPostRepository::class);
            },
        ];
    }
}
