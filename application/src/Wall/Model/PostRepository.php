<?php

declare(strict_types=1);

namespace Wall\Model;

interface PostRepository
{
    public function add(Post $post);
}
