<?php

declare(strict_types=1);

namespace Wall\Application\Query\Result;

final class ClientStatistics
{
    /** @var string */
    public $mostOftenUsedBrowser;

    /** @var string */
    public $mostOftenUsedOS;

    public function __construct(string $mostOftenUsedBrowser = null, string $mostOftenUsedOS = null)
    {
        $this->mostOftenUsedBrowser = $mostOftenUsedBrowser;
        $this->mostOftenUsedOS      = $mostOftenUsedOS;
    }
}
