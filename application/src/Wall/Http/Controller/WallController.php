<?php

declare(strict_types=1);

namespace Wall\Http\Controller;

use Zend\Diactoros\Response;

class WallController
{
    public function __invoke()
    {
        $response = new Response();
        $response->getBody()->write('Hello world!');

        return $response;
    }
}
