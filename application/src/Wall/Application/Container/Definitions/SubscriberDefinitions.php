<?php

declare(strict_types=1);

namespace Wall\Application\Container\Definitions;

use DI;
use Wall\Application\Query\ClientStatisticsProjector;
use Wall\Application\Query\PublisherStatisticsProjector;
use Wall\Application\Subscriber\UpdateClientStatisticsWhenPostWasPublished;
use Wall\Application\Subscriber\UpdatePublisherStatisticsWhenPostWasPublished;
use Wall\Model\PostWasPublished;

final class SubscriberDefinitions implements Definitions
{
    public static function get(): array
    {
        return [
            UpdatePublisherStatisticsWhenPostWasPublished::class => DI\object()
                ->constructor(DI\get(PublisherStatisticsProjector::class)),
            UpdateClientStatisticsWhenPostWasPublished::class => DI\object()
                ->constructor(DI\get(ClientStatisticsProjector::class)),
            'event_subscribers.collection' => [
                PostWasPublished::class => [
                    UpdatePublisherStatisticsWhenPostWasPublished::class,
                    UpdateClientStatisticsWhenPostWasPublished::class,
                ],
            ],
        ];
    }
}
