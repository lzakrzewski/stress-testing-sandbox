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

    /** @var \DateTime */
    private $at;

    public function __construct(UuidInterface $postId, string $publisher, string $content, \DateTime $at)
    {
        $this->postId    = $postId;
        $this->content   = $content;
        $this->publisher = $publisher;
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
