<?php

declare(strict_types=1);

namespace Wall\Http\Controller;

use DI\Container;
use Wall\Http\Response\HtmlResponse;

class WallController
{
    /** @var Container */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function publishPostAction()
    {
        return new HtmlResponse('<body>Post created!</body>', 201);
    }

    public function wallAction()
    {
        return $this->render('index.html.twig');
    }

    private function render(string $templateName): HtmlResponse
    {
        return new HtmlResponse($this->container->get(\Twig_Environment::class)->render($templateName));
    }
}
