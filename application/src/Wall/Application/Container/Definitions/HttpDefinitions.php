<?php

declare(strict_types=1);

namespace Wall\Application\Container\Definitions;

use DI\Container;
use Wall\Http\Controller\WallController;
use Wall\Http\Routing\WallActionDispatcher;

final class HttpDefinitions implements Definition
{
    public static function get(): array
    {
        return [
            WallController::class => function (Container $container) {
                return new WallController($container);
            },
            WallActionDispatcher::class => function (Container $container) {
                return new WallActionDispatcher($container->get(WallController::class));
            },
        ];
    }
}
