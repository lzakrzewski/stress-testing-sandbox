<?php

declare(strict_types=1);

namespace tests\integration\Wall\Infrastructure\Query\Cache;

use tests\integration\Wall\Infrastructure\CacheTestCase;

class RedisClientStatisticsProjectorTest extends CacheTestCase
{
    /** @test */
    public function it_applies_when_post_was_created_when_no_posts()
    {
        $this->markTestIncomplete();
    }

    /** @test */
    public function it_applies_when_post_was_created_when_a_few_posts_were_already_published()
    {
        $this->markTestIncomplete();
    }
}
