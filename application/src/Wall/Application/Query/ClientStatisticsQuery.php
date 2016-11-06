<?php

declare(strict_types=1);

namespace Wall\Application\Query;

use Wall\Application\Query\Result\ClientStatisticsResult;

interface ClientStatisticsQuery
{
    public function get(): ClientStatisticsResult;
}
