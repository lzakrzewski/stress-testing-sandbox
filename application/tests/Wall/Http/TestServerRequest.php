<?php

declare(strict_types=1);

namespace tests\Wall\Http;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\ServerRequest;

class TestServerRequest extends ServerRequest
{
    /** @var string|null */
    private static $mockedUserAgent;

    /**
     * @param string $userAgent
     */
    public static function mockUserAgent(string $userAgent)
    {
        self::$mockedUserAgent = $userAgent;
    }

    /**
     * @param string $header
     *
     * @return array
     */
    public function getHeader($header)
    {
        $this->applyMockedUserAgent();

        return parent::getHeader($header);
    }

    /**
     * @return array|mixed
     */
    public function getHeaders()
    {
        $this->applyMockedUserAgent();

        return parent::getHeaders();
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @return TestServerRequest
     */
    public static function fromServerRequest(ServerRequestInterface $request): self
    {
        return new self(
            $request->getServerParams(),
            $request->getUploadedFiles(),
            $request->getUri(),
            $request->getMethod(),
            $request->getBody(),
            $request->getHeaders(),
            $request->getCookieParams(),
            $request->getQueryParams(),
            $request->getParsedBody(),
            $request->getProtocolVersion()
        );
    }

    public static function resetMockedUserAgent()
    {
        self::$mockedUserAgent = null;
    }

    private function applyMockedUserAgent()
    {
        if (null === self::$mockedUserAgent) {
            return;
        }

        $this->headerNames['user-agent'] = 'user-agent';
        $this->headers['user-agent']     = self::$mockedUserAgent;
    }
}
