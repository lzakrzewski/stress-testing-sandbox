<?php

declare(strict_types=1);

namespace Wall\Application\Query\Result;

final class PublisherStatistics
{
    /** @var int */
    public $postCount;

    public function __construct(int $postCount = 0)
    {
        $this->postCount = $postCount;
    }
}
