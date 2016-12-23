<?php

declare(strict_types=1);

namespace Wall\Http\Routing;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Wall\Http\Controller\WallController;

class WallActionDispatcher
{
    private $controller;

    public function __construct(WallController $controller)
    {
        $this->controller = $controller;
    }

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        if ('POST' == strtoupper($request->getMethod())) {
            return $this->controller->publishPostAction($request);
        }

        return $this->controller->wallAction($request);
    }
}
