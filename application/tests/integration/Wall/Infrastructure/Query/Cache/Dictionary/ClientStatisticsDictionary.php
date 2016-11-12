<?php

declare(strict_types=1);

namespace tests\integration\Wall\Infrastructure\Query\Cache\Dictionary;

use DI\Container;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\ServerRequest;

trait ClientStatisticsDictionary
{
    private function requestWithUserAgent(string $userAgent): ServerRequestInterface
    {
        return (new ServerRequest([], [], 'http://localhost/publish-post', 'POST'))
            ->withHeader('user-agent', [$userAgent]);
    }

    abstract protected function container(): Container;
}
