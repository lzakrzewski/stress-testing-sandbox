<?php

declare(strict_types=1);

namespace tests\Wall\Application\Container;

use DI;
use DI\ContainerBuilder as DIContainerBuilder;
use tests\Wall\Application\CommandBus\CollectEventsMiddleware;
use Wall\Application\Container\ContainerBuilder;

final class TestContainerBuilder
{
    public static function create(): DIContainerBuilder
    {
        $builder = ContainerBuilder::create();

        $builder->addDefinitions([
            CollectEventsMiddleware::class => DI\object(),
            'event_bus'                    => DI\decorate(function ($eventBus, DI\Container $c) {
                $eventBus->appendMiddleware($c->get(CollectEventsMiddleware::class));

                return $eventBus;
            }),
        ]);

        return $builder;
    }
}
