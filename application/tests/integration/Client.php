<?php

declare(strict_types=1);

namespace tests\integration;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\BrowserKit\Client as BaseClient;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;
use Symfony\Component\BrowserKit\Response as BrowserKitResponse;
use Wall\Http\Controller\WallController;
use Zend\Diactoros\Request;

class Client extends BaseClient
{
    protected function doRequest($request): BrowserKitResponse
    {
        $psr7Request  = $this->convertToPsr7Request($request);
        $psr7Response = (new WallController())->__invoke($psr7Request);

        return $this->convertToBrowserKitResponse($psr7Response);
    }

    private function convertToPsr7Request(BrowserKitRequest $request): RequestInterface
    {
        return new Request(
            $request->getUri(),
            $request->getMethod()
        );
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
