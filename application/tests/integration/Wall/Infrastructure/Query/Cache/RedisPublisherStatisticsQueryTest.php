<?php

declare(strict_types=1);

namespace integration\Wall\Infrastructure\Query\Cache;

use Predis\Client as RedisClient;
use tests\integration\IntegrationTestCase;
use Wall\Application\Query\PublisherStatisticsQuery;
use Wall\Application\Query\Result\PublisherStatistics;
use Wall\Infrastructure\Query\Cache\RedisPublisherStatisticsQuery;

class RedisPublisherStatisticsQueryTest extends IntegrationTestCase
{
    /** @var RedisClient */
    private $redis;

    /** @var RedisPublisherStatisticsQuery */
    private $query;

    /** @test */
    public function it_return_empty_statistics_when_none_post_has_been_published()
    {
        $statistics = $this->query->get();

        $this->assertEquals(new PublisherStatistics(0), $statistics);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->redis = $this->container()->get(RedisClient::class);
        $this->query = $this->container()->get(PublisherStatisticsQuery::class);

        $this->redis->flushall();
    }

    protected function tearDown()
    {
        $this->redis = null;
        $this->query = null;

        parent::tearDown();
    }
}
