<?php

declare(strict_types=1);

namespace Wall\Application\Command;

use Wall\Model\Post;
use Wall\Model\PostRepository;

final class PublishPostHandler
{
    /** @var PostRepository */
    private $posts;

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function handle(PublishPost $publishPost)
    {
        $post = Post::publish(
            $publishPost->postId(),
            $publishPost->publisher(),
            $publishPost->content(),
            $publishPost->at()
        );

        $this->posts->add($post);
    }
}
