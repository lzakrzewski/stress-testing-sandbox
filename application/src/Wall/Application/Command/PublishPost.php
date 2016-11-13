<?php

declare(strict_types=1);

namespace Wall\Application\Command;

use Ramsey\Uuid\UuidInterface;

final class PublishPost
{
    /** @var UuidInterface */
    private $postId;

    /** @var string */
    private $publisher;

    /** @var string */
    private $content;

    public function __construct(UuidInterface $postId, string $publisher, string $content)
    {
        $this->postId    = $postId;
        $this->content   = $content;
        $this->publisher = $publisher;
    }

    public function postId(): UuidInterface
    {
        return $this->postId;
    }

    public function publisher(): string
    {
        return $this->publisher;
    }

    public function content(): string
    {
        return $this->content;
    }
}
