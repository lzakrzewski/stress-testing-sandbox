<?php

declare(strict_types=1);

namespace Wall\Http\Server;

use Psr\Http\Message\ServerRequestInterface;
use Wall\Application\Container\ContainerBuilder;
use Wall\Http\Routing\WallActionDispatcher;
use Zend\Diactoros\Server;

final class WebServer
{
    public function run()
    {
        $container = ContainerBuilder::create()->build();

        $server = Server::createServerFromRequest(
            $container->get(WallActionDispatcher::class),
            $container->get(ServerRequestInterface::class)
        );

        $server->listen();
    }
}
