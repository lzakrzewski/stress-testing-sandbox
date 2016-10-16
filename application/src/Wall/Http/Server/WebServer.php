<?php

declare(strict_types=1);

namespace Wall\Http\Server;

use Wall\Application\ContainerFactory;
use Wall\Http\Controller\WallController;
use Zend\Diactoros\Server;
use Zend\Diactoros\ServerRequestFactory;

final class WebServer
{
    public function run()
    {
        $container = ContainerFactory::create();

        $server = Server::createServerFromRequest(
            new WallController($container),
            ServerRequestFactory::fromGlobals()
        );

        $server->listen();
    }
}
