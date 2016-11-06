<?php

declare(strict_types=1);

namespace Wall\Application\Subscriber;

use Wall\Application\Query\ClientStatisticsProjector;

class UpdateClientStatisticsWhenPostWasPublished
{
    /** @var ClientStatisticsProjector */
    private $projector;

    public function __construct(ClientStatisticsProjector $projector)
    {
        $this->projector = $projector;
    }

    public function notify()
    {
        $this->projector->project();
    }
}
