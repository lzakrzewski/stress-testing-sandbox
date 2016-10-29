<?php

declare(strict_types=1);

namespace Wall\Application\Query;

use Wall\Application\Query\Result\PublisherStatistics;

interface PublisherStatisticsQuery
{
    public function get(): PublisherStatistics;
}
