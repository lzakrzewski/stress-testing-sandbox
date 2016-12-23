<?php

declare(strict_types=1);

namespace Wall\Application\Container\Definitions;

use DI;
use Wall\Application\Command\PublishPost;
use Wall\Application\Command\PublishPostHandler;
use Wall\Model\PostRepository;

final class CommandHandlerDefinitions implements Definitions
{
    public static function get(): array
    {
        return [
            PublishPostHandler::class => DI\object()
                ->constructor(DI\get(PostRepository::class)),
            'command_handlers.map' => [
                PublishPost::class => PublishPostHandler::class,
            ],
        ];
    }
}
