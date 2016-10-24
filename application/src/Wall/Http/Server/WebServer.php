<?php

declare(strict_types=1);

namespace Wall\Http\Server;

use Wall\Application\Container\ContainerBuilder;
use Wall\Http\Routing\WallActionDispatcher;
use Zend\Diactoros\Server;
use Zend\Diactoros\ServerRequestFactory;

final class WebServer
{
    public function run()
    {
        $container = ContainerBuilder::create()->build();

        $server = Server::createServerFromRequest(
            $container->get(WallActionDispatcher::class),
            ServerRequestFactory::fromGlobals()
        );

        $server->listen();
    }
}
