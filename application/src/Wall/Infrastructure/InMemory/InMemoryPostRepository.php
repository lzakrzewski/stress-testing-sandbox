<?php

declare(strict_types=1);

namespace Wall\Infrastructure\InMemory;

use Ramsey\Uuid\UuidInterface;
use Wall\Model\Post;
use Wall\Model\PostRepository;

class InMemoryPostRepository implements PostRepository
{
    /** @var array */
    private $storage = [];

    public function add(Post $post)
    {
        $this->storage[$post->postId()->toString()] = $post;
    }

    public function get(UuidInterface $postId): Post
    {
        if (!isset($this->storage[$postId->toString()])) {
            throw new \RuntimeException(sprintf('Post with id %s does not exist.', $postId->toString()));
        }

        return $this->storage[$postId->toString()];
    }
}
