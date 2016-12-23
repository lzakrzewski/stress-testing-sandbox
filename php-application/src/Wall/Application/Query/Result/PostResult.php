<?php

declare(strict_types=1);

namespace Wall\Application\Query\Result;

final class PostResult
{
    /** @var string */
    public $postId;

    /** @var string */
    public $content;

    /** @var \DateTime */
    public $at;

    /** @var string */
    public $publisher;

    public function __construct(string $postId, string $publisher, string $content, \DateTime $at)
    {
        $this->postId    = $postId;
        $this->publisher = $publisher;
        $this->content   = $content;
        $this->at        = $at;
    }
}
