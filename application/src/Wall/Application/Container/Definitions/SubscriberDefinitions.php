<?php

declare(strict_types=1);

namespace Wall\Application\Container\Definitions;

use DI;
use Wall\Application\Query\ClientStatisticsProjector;
use Wall\Application\Query\PostsListProjector;
use Wall\Application\Query\PublisherStatisticsProjector;
use Wall\Model\PostWasPublished;

final class SubscriberDefinitions implements Definitions
{
    public static function get(): array
    {
        return [
            'event_subscribers.collection' => function (DI\Container $container) {
                return [
                    PostWasPublished::class => [
                        [
                            $container->get(PostsListProjector::class),
                            'applyThatPostWasPublished',
                        ],
                        [
                            $container->get(PublisherStatisticsProjector::class),
                            'applyThatPostWasPublished',
                        ],
                        [
                            $container->get(ClientStatisticsProjector::class),
                            'project',
                        ],
                    ],
                ];
            },
        ];
    }
}
