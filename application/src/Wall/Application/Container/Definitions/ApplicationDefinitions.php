<?php

declare(strict_types=1);

namespace Wall\Application\Container\Definitions;

use DI\Container;
use Wall\Application\Command\PublishPost;
use Wall\Application\Command\PublishPostHandler;
use Wall\Model\PostRepository;

final class ApplicationDefinitions implements Definition
{
    public static function get(): array
    {
        return [
            PublishPostHandler::class => function (Container $container) {
                return new PublishPostHandler($container->get(PostRepository::class));
            },
            'command_handlers.map' => [
                PublishPost::class => PublishPostHandler::class,
            ],
        ];
    }
}
