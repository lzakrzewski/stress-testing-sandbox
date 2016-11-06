<?php

declare(strict_types=1);

namespace tests\integration\Wall\Infrastructure\Query\Cache\Dictionary;

use DeviceDetector\DeviceDetector;
use DI\Container;
use Predis\Client as RedisClient;
use Psr\Http\Message\ServerRequestInterface;
use Wall\Infrastructure\Query\Cache\RedisClientStatisticsProjector;
use Zend\Diactoros\ServerRequest;

trait ClientStatisticsDictionary
{
    private function requestWithUserAgent(string $userAgent): ServerRequestInterface
    {
        return (new ServerRequest([], [], 'http://localhost/publish-post', 'POST'))
            ->withHeader('user-agent', [$userAgent]);
    }

    private function given(...$requests)
    {
        foreach ($requests as $request) {
            $projector = new RedisClientStatisticsProjector(
                $this->container()->get(RedisClient::class),
                $this->container()->get(DeviceDetector::class),
                $request
            );

            $projector->project();
        }
    }

    abstract protected function container(): Container;
}
