<?php

declare(strict_types=1);

namespace integration\Wall\Application\Subscriber;

use tests\integration\Wall\Infrastructure\CacheTestCase;

class UpdatePostsListWhenPostWasPublishedTest extends CacheTestCase
{
    /** @test */
    public function it_calls_projector_when_post_was_published()
    {
        $this->markTestIncomplete();
    }
}
