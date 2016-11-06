<?php

declare(strict_types=1);

namespace Wall\Application\Query\Result;

final class PublisherStatisticsResult
{
    /** @var int */
    public $postCount;

    /** @var string */
    private $mostActivePublisher;

    public function __construct(int $postCount = 0, string $mostActivePublisher = null)
    {
        $this->postCount           = $postCount;
        $this->mostActivePublisher = $mostActivePublisher;
    }
}
