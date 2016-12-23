<?php

declare(strict_types=1);

namespace Wall\Model;

use Ramsey\Uuid\UuidInterface;

final class PostWasPublished
{
    /** @var UuidInterface */
    private $postId;

    /** @var string */
    private $publisher;

    /** @var string */
    private $content;

    /** @var \DateTime */
    private $at;

    public function __construct(UuidInterface $postId, string $publisher, string $content, \DateTime $at)
    {
        $this->postId    = $postId;
        $this->publisher = $publisher;
        $this->content   = $content;
        $this->at        = $at;
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

    public function at(): \DateTime
    {
        return $this->at;
    }
}
