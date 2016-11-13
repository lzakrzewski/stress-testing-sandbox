<?php

declare(strict_types=1);

namespace tests\Wall\Application\Container;

use DI;
use DI\ContainerBuilder as DIContainerBuilder;
use Psr\Http\Message\ServerRequestInterface;
use SimpleBus\Message\Bus\MessageBus;
use tests\Wall\Application\CommandBus\CollectEventsMiddleware;
use tests\Wall\Http\TestServerRequest;
use Wall\Application\Container\ContainerBuilder;

final class TestContainerBuilder
{
    public static function create(): DIContainerBuilder
    {
        $builder = ContainerBuilder::create();

        $builder->addDefinitions([
            CollectEventsMiddleware::class => DI\object(),
            'event_bus'                    => DI\decorate(function (MessageBus $eventBus, DI\Container $container) {
                $eventBus->appendMiddleware($container->get(CollectEventsMiddleware::class));

                return $eventBus;
            }),
            ServerRequestInterface::class => DI\decorate(function (ServerRequestInterface $request) {
                return TestServerRequest::fromServerRequest($request);
            }),
        ]);

        return $builder;
    }
}
