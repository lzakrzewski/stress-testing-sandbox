<?php

declare(strict_types=1);

namespace Wall\Model;

use Assert\Assertion;
use Ramsey\Uuid\UuidInterface;

//Todo: Encapsulate date of creation
final class Post
{
    /** @var UuidInterface */
    private $postId;

    /** @var string */
    private $content;

    /** @var \DateTime */
    private $at;

    /** @var array */
    private $events = [];

    /** @var string */
    private $publisher;

    private function __construct(UuidInterface $postId, string $publisher, string $content, \DateTime $at)
    {
        Assertion::notEmpty($publisher, 'Publisher should not be blank.');
        Assertion::email($publisher, 'Email of publisher is invalid.');
        Assertion::notEmpty($content, 'Content should not be blank.');

        $this->postId    = $postId;
        $this->publisher = $publisher;
        $this->content   = $content;
        $this->at        = $at;

        $this->recordThat(new PostWasPublished($this->postId, $this->publisher, $this->content, $this->at));
    }

    public static function publish(UuidInterface $postId, string $publisher, string $content, \DateTime $at): self
    {
        return new self($postId, $publisher, $content, $at);
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

    public function events(): array
    {
        return $this->events;
    }

    private function recordThat(PostWasPublished $event)
    {
        $this->events[] = $event;
    }
}
