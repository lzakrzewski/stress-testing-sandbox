<?php

declare(strict_types=1);

namespace integration\Wall\Infrastructure\Query\Cache\Dictionary;

use DI\Container;

trait PostsListDictionary
{
    abstract protected function container(): Container;
}
