<?php

declare(strict_types=1);

namespace Wall\Http\Controller;

use DI\Container;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Ramsey\Uuid\Uuid;
use Wall\Application\Command\PublishPost;
use Wall\Http\Response\HtmlResponse;

class WallController
{
    /** @var Container */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function publishPostAction(RequestInterface $request): ResponseInterface
    {
        $postData = $this->postData($request);

        try {
            $this->container->get('command_bus')->handle(
                new PublishPost(Uuid::uuid4(), $postData['publisher'], $postData['content'], new \DateTime())
            );
        } catch (\InvalidArgumentException $exception) {
            return $this->render(
                'index.html.twig',
                [
                    'error' => $exception->getMessage(),
                ],
                400
            );
        }

        return $this->render('index.html.twig', ['success' => 'Post created!'], 201);
    }

    public function wallAction(): ResponseInterface
    {
        return $this->render('index.html.twig', ['posts' => []]);
    }

    private function render(string $templateName, array $parameters = [], $status = 200): HtmlResponse
    {
        return new HtmlResponse(
            $this->container
                ->get(\Twig_Environment::class)
                ->render($templateName, $parameters),
            $status
        );
    }

    private function postData(RequestInterface $request): array
    {
        parse_str((string) $request->getBody(), $postData);

        return array_merge(['content' => '', 'publisher' => ''], $postData);
    }
}
