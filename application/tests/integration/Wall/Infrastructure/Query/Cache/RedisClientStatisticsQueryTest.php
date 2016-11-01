<?php

declare(strict_types=1);

namespace tests\integration\Wall\Infrastructure\Query\Cache;

use tests\integration\Wall\Infrastructure\CacheTestCase;
use Wall\Application\Query\ClientStatisticsQuery;
use Wall\Application\Query\Result\ClientStatistics;
use Wall\Infrastructure\Query\Cache\RedisClientStatisticsQuery;

class RedisClientStatisticsQueryTest extends CacheTestCase
{
    /** @var RedisClientStatisticsQuery */
    private $query;

    /** @test */
    public function it_return_empty_statistics_when_none_post_has_been_published()
    {
        $statistics = $this->query->get();

        $this->assertEquals(new ClientStatistics(null, null), $statistics);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->query = $this->container()->get(ClientStatisticsQuery::class);
    }

    protected function tearDown()
    {
        $this->query = null;

        parent::tearDown();
    }
}
