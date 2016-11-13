<?php

declare(strict_types=1);

namespace Wall\Infrastructure\Persistence\EventBus;

use SimpleBus\Message\Bus\MessageBus;
use Wall\Model\Post;
use Wall\Model\PostRepository;

class RecordedEventDispatchingPostRepository implements PostRepository
{
    /** @var MessageBus */
    private $eventBus;

    public function __construct(MessageBus $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function add(Post $post)
    {
        foreach ($post->events() as $event) {
            $this->eventBus->handle($event);
        }
    }
}
