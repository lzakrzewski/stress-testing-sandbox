<?php

declare(strict_types=1);

namespace tests\contexts;

use Assert\Assertion;
use Behat\Behat\Context\Context;
use DI\Container;
use Predis\Client as RedisClient;
use SimpleBus\Message\Bus\MessageBus;
use tests\Wall\Application\CommandBus\CollectEventsMiddleware;
use tests\Wall\Application\Container\TestContainerBuilder;
use Wall\Application\Query\PostsListQuery;

abstract class FeatureContext implements Context
{
    /** @var Container */
    private $container;

    /** @var \Exception[] */
    private $exceptions = [];

    public function __construct()
    {
        $this->container = TestContainerBuilder::create()->build();
    }

    public function afterScenario()
    {
        $this->exceptions = [];

        $this->container->get(RedisClient::class)->flushAll();
    }

    protected function handle($command)
    {
        try {
            $this->commandBus()->handle($command);
        } catch (\Exception $exception) {
            $this->exceptions[] = $exception;
        }
    }

    protected function posts(): array
    {
        return $this->container->get(PostsListQuery::class)->get();
    }

    protected function expectEvent(string $eventClass)
    {
        $events = $this->filterByClassName(
            $this->container->get(CollectEventsMiddleware::class)->events(),
            $eventClass
        );

        Assertion::greaterThan(count($events), 0, sprintf('Expected at least one event of class %s', $eventClass));
        Assertion::allIsInstanceOf($events, $eventClass);
    }

    protected function expectException(string $exceptionClass)
    {
        $exceptions = $this->filterByClassName(
            $this->exceptions,
            $exceptionClass
        );

        Assertion::greaterThan(count($exceptions), 0, sprintf('Expected at least one exception of class %s', $exceptionClass));
        Assertion::allIsInstanceOf($exceptions, $exceptionClass);
    }

    private function commandBus(): MessageBus
    {
        return $this->container->get('command_bus');
    }

    private function filterByClassName(array $elements, string $expectedClass)
    {
        return array_filter($elements, function ($event) use ($expectedClass) {
            return $event instanceof $expectedClass;
        });
    }
}
