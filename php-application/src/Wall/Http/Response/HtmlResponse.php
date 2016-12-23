<?php

declare(strict_types=1);

namespace Wall\Http\Response;

use Psr\Http\Message\StreamInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\InjectContentTypeTrait;
use Zend\Diactoros\Stream;

final class HtmlResponse extends Response
{
    use InjectContentTypeTrait;

    public function __construct(string $html, int $status = 200, array $headers = [])
    {
        parent::__construct(
            $this->createBody($html),
            $status,
            $this->injectContentType('text/html; charset=utf-8', $headers)
        );
    }

    private function createBody(string $html): StreamInterface
    {
        $body = new Stream('php://temp', 'wb+');
        $body->write($html);
        $body->rewind();

        return $body;
    }
}
