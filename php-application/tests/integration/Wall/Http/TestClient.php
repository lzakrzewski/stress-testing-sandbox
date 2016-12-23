<?php

declare(strict_types=1);

namespace tests\integration\Wall\Http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\BrowserKit\Client as BaseClient;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;
use Symfony\Component\BrowserKit\Response as BrowserKitResponse;
use tests\Wall\Application\Container\TestContainerBuilder;
use Wall\Http\Routing\WallActionDispatcher;
use Zend\Diactoros\Request;

class TestClient extends BaseClient
{
    protected function doRequest($request): BrowserKitResponse
    {
        $container = TestContainerBuilder::create()->build();

        $psr7Request  = $this->convertToPsr7Request($request);
        $psr7Response = $container->get(WallActionDispatcher::class)->__invoke($psr7Request);

        return $this->convertToBrowserKitResponse($psr7Response);
    }

    private function convertToPsr7Request(BrowserKitRequest $browserKitRequest): RequestInterface
    {
        $psr7Request = new Request(
            $browserKitRequest->getUri(),
            $browserKitRequest->getMethod()
        );

        if (!empty($parameters = $browserKitRequest->getParameters())) {
            $psr7Request->getBody()->write(http_build_query($parameters));
        }

        return $psr7Request;
    }

    private function convertToBrowserKitResponse(ResponseInterface $psr7Response): BrowserKitResponse
    {
        return new BrowserKitResponse(
            (string) $psr7Response->getBody(),
            $psr7Response->getStatusCode(),
            $psr7Response->getHeaders()
        );
    }
}
