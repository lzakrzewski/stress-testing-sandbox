<?php

declare(strict_types=1);

namespace Wall\Application\Query;

use Wall\Model\PostWasPublished;

interface ClientStatisticsProjector
{
    public function applyThatPostWasPublished(PostWasPublished $event);
}
