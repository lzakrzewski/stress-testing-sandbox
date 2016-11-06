<?php

declare(strict_types=1);

namespace tests\integration\Wall\Infrastructure\Query\Cache\Dictionary;

use DI\Container;
use Wall\Application\Query\PublisherStatisticsProjector;

trait PublisherStatisticsDictionary
{
    private function given(...$events)
    {
        foreach ($events as $event) {
            $this->container()->get(PublisherStatisticsProjector::class)->applyThatPostWasPublished($event);
        }
    }

    abstract protected function container(): Container;
}
