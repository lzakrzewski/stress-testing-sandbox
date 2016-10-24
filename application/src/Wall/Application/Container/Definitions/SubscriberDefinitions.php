<?php

declare(strict_types=1);

namespace Wall\Application\Container\Definitions;

use Wall\Application\Subscriber\UpdatePostProjectionWhenPostWasPublished;
use Wall\Model\PostWasPublished;

final class SubscriberDefinitions implements Definition
{
    public static function get(): array
    {
        return [
            UpdatePostProjectionWhenPostWasPublished::class => function () {
                return new UpdatePostProjectionWhenPostWasPublished();
            },
            'event_subscribers.collection' => [
                PostWasPublished::class => [
                    UpdatePostProjectionWhenPostWasPublished::class,
                ],
            ],
        ];
    }
}
