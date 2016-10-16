<?php

declare(strict_types=1);

namespace Wall\Http\Controller;

use Wall\Http\Response\HtmlResponse;

class WallController
{
    public function __invoke()
    {
        return new HtmlResponse('<body>Hello world!</body>');
    }
}
