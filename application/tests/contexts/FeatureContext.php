<?php

declare(strict_types=1);

namespace tests\contexts;

use Behat\Behat\Context\Context;
use DI\Container;
use SimpleBus\Message\Bus\MessageBus;
use Wall\Application\Container\ContainerFactory;

abstract class FeatureContext implements Context
{
    /** @var Container */
    private $container;

    public function __construct()
    {
        $this->container = ContainerFactory::create();
    }

    protected function commandBus(): MessageBus
    {
        return $this->container->get(MessageBus::class);
    }
}
