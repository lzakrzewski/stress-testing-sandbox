<?php

declare(strict_types=1);

namespace tests\unit\Wall\Http\Response;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamInterface;
use Wall\Http\Response\HtmlResponse;

class HtmlResponseTest extends TestCase
{
    /** @var HtmlResponse */
    private $response;

    /** @test */
    public function it_has_stream_body()
    {
        $this->assertInstanceOf(StreamInterface::class, $this->response->getBody());
        $this->assertEquals('<body>Hello world!</body>', (string) $this->response->getBody());
    }

    /** @test */
    public function it_has_html_text_header()
    {
        $this->assertArrayHasKey('content-type', $this->response->getHeaders());
        $this->assertEquals('text/html; charset=utf-8', $this->response->getHeaders()['content-type'][0]);
    }

    /** @test */
    public function it_has_default_status_code()
    {
        $this->assertEquals(200, $this->response->getStatusCode());
    }

    /** @test */
    public function it_has_status()
    {
        $response = new HtmlResponse('<body>Not found!</body>', 404);

        $this->assertEquals(404, $response->getStatusCode());
    }

    protected function setUp()
    {
        $this->response = new HtmlResponse('<body>Hello world!</body>');
    }

    protected function tearDown()
    {
        $this->response = null;
    }
}
