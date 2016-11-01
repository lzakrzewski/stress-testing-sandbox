<?php

declare(strict_types=1);

namespace Wall\Application\Container\Definitions;

use DI;
use DI\Container;
use Psr\Http\Message\ServerRequestInterface;
use Wall\Http\Controller\WallController;
use Wall\Http\Routing\WallActionDispatcher;
use Zend\Diactoros\ServerRequestFactory;

final class HttpDefinitions implements Definition
{
    public static function get(): array
    {
        return [
            ServerRequestInterface::class => function () {
                return ServerRequestFactory::fromGlobals();
            },
            WallController::class => DI\object()
                ->constructor(DI\get(Container::class)),
            WallActionDispatcher::class => DI\object()
                ->constructor(DI\get(WallController::class)),
        ];
    }
}
