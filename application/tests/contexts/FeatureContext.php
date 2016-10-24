<?php

declare(strict_types=1);

namespace tests\contexts;

use Assert\Assertion;
use Behat\Behat\Context\Context;
use DI\Container;
use SimpleBus\Message\Bus\MessageBus;
use tests\Wall\Application\CommandBus\CollectEventsMiddleware;
use tests\Wall\Application\Container\TestContainerBuilder;
use Wall\Model\PostRepository;

abstract class FeatureContext implements Context
{
    /** @var Container */
    private $container;

    public function __construct()
    {
        $this->container = TestContainerBuilder::create()->build();
    }

    protected function commandBus(): MessageBus
    {
        return $this->container->get('command_bus');
    }

    protected function posts(): PostRepository
    {
        return $this->container->get(PostRepository::class);
    }

    protected function expectEvent(string $eventClass)
    {
        $events = $this->container->get(CollectEventsMiddleware::class)->events();

        Assertion::allIsInstanceOf(array_filter($events, function ($event) use ($eventClass) {
            return $event instanceof $eventClass;
        }), $eventClass);
    }
}
