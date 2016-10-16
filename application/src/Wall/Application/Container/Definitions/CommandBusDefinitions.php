<?php

declare(strict_types=1);

namespace Wall\Application\Container\Definitions;

use DI\Container;
use SimpleBus\Message\Bus\MessageBus;
use SimpleBus\Message\Bus\Middleware\FinishesHandlingMessageBeforeHandlingNext;
use SimpleBus\Message\Bus\Middleware\MessageBusSupportingMiddleware;
use SimpleBus\Message\CallableResolver\CallableMap;
use SimpleBus\Message\CallableResolver\ServiceLocatorAwareCallableResolver;
use SimpleBus\Message\Handler\DelegatesToMessageHandlerMiddleware;
use SimpleBus\Message\Handler\Resolver\NameBasedMessageHandlerResolver;
use SimpleBus\Message\Name\ClassBasedNameResolver;
use Wall\Application\Command\AddPostToWall;
use Wall\Application\Command\AddPostToWallHandler;

final class CommandBusDefinitions
{
    public static function get(): array
    {
        return [
            AddPostToWallHandler::class => function () {
                return new AddPostToWallHandler();
            },
            'command_handlers.map' => [
                AddPostToWall::class => AddPostToWallHandler::class,
            ],
            NameBasedMessageHandlerResolver::class => function (Container $container) {
                $serviceLocator = function (string $serviceId) use ($container) {
                    return $container->get($serviceId);
                };

                $commandHandlerMap = new CallableMap(
                    $container->get('command_handlers.map'),
                    new ServiceLocatorAwareCallableResolver($serviceLocator)
                );

                return new NameBasedMessageHandlerResolver(new ClassBasedNameResolver(), $commandHandlerMap);
            },
            DelegatesToMessageHandlerMiddleware::class => function (Container $container) {
                return new DelegatesToMessageHandlerMiddleware($container->get(NameBasedMessageHandlerResolver::class));
            },
            MessageBusSupportingMiddleware::class => function (Container $container) {
                $commandBus = new MessageBusSupportingMiddleware([new FinishesHandlingMessageBeforeHandlingNext()]);
                $commandBus->appendMiddleware($container->get(DelegatesToMessageHandlerMiddleware::class));

                return $commandBus;
            },
            MessageBus::class => function (Container $container) {
                return $container->get(MessageBusSupportingMiddleware::class);
            },
        ];
    }
}
