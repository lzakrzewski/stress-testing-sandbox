<?php

declare(strict_types=1);

namespace tests\integration\Wall\Infrastructure\Query\Cache;

use tests\integration\Wall\Infrastructure\CacheTestCase;

class RedisPostsListProjectorTest extends CacheTestCase
{
    /** @test */
    public function it_projects_post_list_when_post_was_published()
    {
        $this->markTestIncomplete();
    }
}
