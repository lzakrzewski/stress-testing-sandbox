<?php

declare(strict_types=1);

namespace Wall\Application\Container\Definitions;

use DI\Container;
use SimpleBus\Message\Bus\Middleware\FinishesHandlingMessageBeforeHandlingNext;
use SimpleBus\Message\Bus\Middleware\MessageBusSupportingMiddleware;
use SimpleBus\Message\CallableResolver\CallableMap;
use SimpleBus\Message\CallableResolver\ServiceLocatorAwareCallableResolver;
use SimpleBus\Message\Handler\DelegatesToMessageHandlerMiddleware;
use SimpleBus\Message\Handler\Resolver\NameBasedMessageHandlerResolver;
use SimpleBus\Message\Name\ClassBasedNameResolver;

final class CommandBusDefinitions implements Definitions
{
    public static function get(): array
    {
        return [
            'command_bus.name_based.resolver' => function (Container $container) {
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
                return new DelegatesToMessageHandlerMiddleware($container->get('command_bus.name_based.resolver'));
            },
            'command_bus' => function (Container $container) {
                $commandBus = new MessageBusSupportingMiddleware([new FinishesHandlingMessageBeforeHandlingNext()]);
                $commandBus->appendMiddleware($container->get(DelegatesToMessageHandlerMiddleware::class));

                return $commandBus;
            },
        ];
    }
}
