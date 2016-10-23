<?php

declare(strict_types=1);

namespace tests\integration;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\BrowserKit\Client as BaseClient;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;
use Symfony\Component\BrowserKit\Response as BrowserKitResponse;
use Wall\Application\Container\ContainerFactory;
use Wall\Http\Routing\WallActionDispatcher;
use Zend\Diactoros\Request;

class Client extends BaseClient
{
    protected function doRequest($request): BrowserKitResponse
    {
        $container = ContainerFactory::create();

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
