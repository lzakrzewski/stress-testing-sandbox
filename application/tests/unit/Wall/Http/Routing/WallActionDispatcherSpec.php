<?php

declare(strict_types=1);

namespace tests\unit\Wall\Http\Routing;

use PhpSpec\ObjectBehavior;
use Psr\Http\Message\ResponseInterface;
use Wall\Http\Controller\WallController;
use Wall\Http\Routing\WallActionDispatcher;
use Zend\Diactoros\Request;

//Todo: 404 handle
/** @mixin WallActionDispatcher */
class WallActionDispatcherSpec extends ObjectBehavior
{
    public function let(WallController $controller)
    {
        $this->beConstructedWith($controller);
    }

    public function it_dispatches_action_for_render_wall_with_posts(WallController $controller, ResponseInterface $response)
    {
        $request = new Request('/', 'Get');

        $controller->wallAction($request)->willReturn($response);

        $this->__invoke($request);
    }

    public function it_dispatches_action_for_publish_post(WallController $controller, ResponseInterface $response)
    {
        $request = new Request('/', 'Post');

        $controller->publishPostAction($request)->willReturn($response);

        $this->__invoke($request);
    }
}
