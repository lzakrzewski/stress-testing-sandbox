<?php

declare(strict_types=1);

namespace Wall\Application\Container\Definitions;

use DI\Container;
use SimpleBus\Message\Bus\Middleware\FinishesHandlingMessageBeforeHandlingNext;
use SimpleBus\Message\Bus\Middleware\MessageBusSupportingMiddleware;
use SimpleBus\Message\CallableResolver\CallableCollection;
use SimpleBus\Message\CallableResolver\ServiceLocatorAwareCallableResolver;
use SimpleBus\Message\Name\ClassBasedNameResolver;
use SimpleBus\Message\Subscriber\NotifiesMessageSubscribersMiddleware;
use SimpleBus\Message\Subscriber\Resolver\NameBasedMessageSubscriberResolver;

final class EventBusDefinitions implements Definition
{
    public static function get(): array
    {
        return [
            'event_bus.name_based.resolver' => function (Container $container) {
                $serviceLocator = function (string $serviceId) use ($container) {
                    return $container->get($serviceId);
                };

                $eventSubscribersCollection = new CallableCollection(
                    $container->get('event_subscribers.collection'),
                    new ServiceLocatorAwareCallableResolver($serviceLocator)
                );

                return new NameBasedMessageSubscriberResolver(new ClassBasedNameResolver(), $eventSubscribersCollection);
            },
            NotifiesMessageSubscribersMiddleware::class => function (Container $container) {
                return new NotifiesMessageSubscribersMiddleware($container->get('event_bus.name_based.resolver'));
            },
            'event_bus' => function (Container $container) {
                $eventBus = new MessageBusSupportingMiddleware([new FinishesHandlingMessageBeforeHandlingNext()]);
                $eventBus->appendMiddleware($container->get(NotifiesMessageSubscribersMiddleware::class));

                return $eventBus;
            },
        ];
    }
}
