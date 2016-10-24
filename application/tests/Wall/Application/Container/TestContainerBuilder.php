<?php

declare(strict_types=1);

namespace tests\Wall\Application\Container;

use DI;
use DI\ContainerBuilder as DIContainerBuilder;
use SimpleBus\Message\Bus\Middleware\MessageBusSupportingMiddleware;
use tests\Wall\Application\CommandBus\CollectEventsMiddleware;
use Wall\Application\Container\ContainerBuilder;

final class TestContainerBuilder
{
    public static function create(): DIContainerBuilder
    {
        $builder = ContainerBuilder::create();

        $builder->addDefinitions([
            CollectEventsMiddleware::class => function () {
                return new CollectEventsMiddleware();
            },
            'event_bus' => DI\object(MessageBusSupportingMiddleware::class)
                ->method('appendMiddleware', DI\get(CollectEventsMiddleware::class)),
        ]);

        return $builder;
    }
}
