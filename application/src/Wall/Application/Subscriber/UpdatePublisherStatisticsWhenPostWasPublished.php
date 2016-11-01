<?php

declare(strict_types=1);

namespace Wall\Application\Subscriber;

use Wall\Application\Query\PublisherStatisticsProjector;
use Wall\Model\PostWasPublished;

class UpdatePublisherStatisticsWhenPostWasPublished
{
    /** @var PublisherStatisticsProjector */
    private $projector;

    public function __construct(PublisherStatisticsProjector $projector)
    {
        $this->projector = $projector;
    }

    public function notify(PostWasPublished $postWasPublished)
    {
        $this->projector->applyThatPostWasPublished($postWasPublished);
    }
}
