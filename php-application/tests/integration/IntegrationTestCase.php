<?php

declare(strict_types=1);

namespace tests\integration;

use DI\Container;
use PHPUnit\Framework\TestCase;
use tests\Wall\Application\Container\TestContainerBuilder;

abstract class IntegrationTestCase extends TestCase
{
    /** @var Container */
    private $container;

    protected function setUp()
    {
        $this->container = TestContainerBuilder::create()->build();
    }

    protected function tearDown()
    {
        $this->container = null;
    }

    protected function container(): Container
    {
        return $this->container;
    }
}
