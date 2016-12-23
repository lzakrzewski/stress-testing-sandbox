<?php

declare(strict_types=1);

namespace Wall\Application\Query;

interface PostsListQuery
{
    public function get(): array;
}
