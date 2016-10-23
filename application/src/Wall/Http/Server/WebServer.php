<?php

declare(strict_types=1);

namespace Wall\Http\Server;

use Wall\Application\Container\ContainerFactory;
use Wall\Http\Routing\WallActionDispatcher;
use Zend\Diactoros\Server;
use Zend\Diactoros\ServerRequestFactory;

final class WebServer
{
    public function run()
    {
        $container = ContainerFactory::create();

        $server = Server::createServerFromRequest(
            $container->get(WallActionDispatcher::class),
            ServerRequestFactory::fromGlobals()
        );

        $server->listen();
    }
}
