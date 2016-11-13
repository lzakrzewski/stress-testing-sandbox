<?php

declare(strict_types=1);

namespace tests\integration\Wall\Infrastructure;

use DeviceDetector\DeviceDetector;
use Predis\Client as RedisClient;
use Psr\Http\Message\ServerRequestInterface;
use Wall\Infrastructure\Query\Cache\RedisClientStatisticsProjector;
use Zend\Diactoros\ServerRequest;

abstract class RequestTestCase extends CacheTestCase
{
    protected function givenRequestsWithUserAgentWereExecuted(...$userAgents)
    {
        foreach ($userAgents as $userAgent) {
            $this->projectRequestWithUserAgent($userAgent);
        }
    }

    protected function projectRequestWithUserAgent($userAgent)
    {
        $projector = new RedisClientStatisticsProjector(
            $this->container()->get(RedisClient::class),
            $this->container()->get(DeviceDetector::class),
            $this->requestWithUserAgent($userAgent)
        );

        $projector->project();
    }

    private function requestWithUserAgent(string $userAgent): ServerRequestInterface
    {
        return (new ServerRequest([], [], 'http://localhost/publish-post', 'POST'))
            ->withHeader('user-agent', [$userAgent]);
    }
}
