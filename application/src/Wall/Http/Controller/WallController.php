<?php

declare(strict_types=1);

namespace Wall\Http\Controller;

use DI\Container;
use Wall\Http\Response\HtmlResponse;

final class WallController
{
    /** @var Container */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function __invoke()
    {
        return $this->render('index.html.twig');
    }

    private function render(string $templateName): HtmlResponse
    {
        return new HtmlResponse($this->container->get(\Twig_Environment::class)->render($templateName));
    }
}
