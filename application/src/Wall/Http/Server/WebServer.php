<?php

declare(strict_types=1);

namespace Wall\Http\Server;

use Wall\Http\Controller\WallController;
use Zend\Diactoros\Server;
use Zend\Diactoros\ServerRequestFactory;

final class WebServer
{
    public function run()
    {
        $server = Server::createServerFromRequest(
            new WallController(),
            ServerRequestFactory::fromGlobals()
        );

        $server->listen();
    }
}
