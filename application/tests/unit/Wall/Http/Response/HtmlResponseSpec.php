<?php

declare(strict_types=1);

namespace tests\unit\Wall\Http\Response;

use PhpSpec\ObjectBehavior;
use Psr\Http\Message\StreamInterface;
use Wall\Http\Response\HtmlResponse;

/** @mixin HtmlResponse */
class HtmlResponseSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('<body>Hello world!</body>');
    }

    public function it_has_stream_body()
    {
        $this->getBody()->shouldBeAnInstanceOf(StreamInterface::class);
        $this->getBody()->__toString()->shouldBe('<body>Hello world!</body>');
    }

    public function it_has_html_text_header()
    {
        $this->getHeaders()->shouldHaveKey('content-type');
        $this->getHeaders()['content-type'][0]->shouldBe('text/html; charset=utf-8');
    }

    public function it_has_default_status_code()
    {
        $this->getStatusCode()->shouldBe(200);
    }

    public function it_has_status()
    {
        $this->beConstructedWith('<body>Not found!</body>', 404);

        $this->getStatusCode()->shouldBe(404);
    }
}
