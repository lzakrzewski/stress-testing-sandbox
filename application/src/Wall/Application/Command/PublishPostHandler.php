<?php

declare(strict_types=1);

namespace Wall\Application\Command;

use SimpleBus\Message\Bus\MessageBus;
use Wall\Model\Post;
use Wall\Model\PostRepository;

final class PublishPostHandler
{
    /** @var PostRepository */
    private $posts;

    /** @var MessageBus */
    private $eventBus;

    public function __construct(PostRepository $posts, MessageBus $eventBus)
    {
        $this->posts    = $posts;
        $this->eventBus = $eventBus;
    }

    public function handle(PublishPost $publishPost)
    {
        $post = Post::publish($publishPost->postId(), $publishPost->content(), $publishPost->at());

        $this->posts->add($post);

        $this->eventBus->handle($post->events()[0]);
    }
}
