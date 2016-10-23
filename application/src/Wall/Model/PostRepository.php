<?php

declare(strict_types=1);

namespace Wall\Model;

use Ramsey\Uuid\UuidInterface;

interface PostRepository
{
    public function add(Post $post);

    public function get(UuidInterface $postId): Post;
}
