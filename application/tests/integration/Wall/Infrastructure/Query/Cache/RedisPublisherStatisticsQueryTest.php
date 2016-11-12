<?php

declare(strict_types=1);

namespace tests\integration\Wall\Infrastructure\Query\Cache;

use Ramsey\Uuid\Uuid;
use tests\integration\Wall\Infrastructure\CacheTestCase;
use Wall\Application\Query\PublisherStatisticsQuery;
use Wall\Application\Query\Result\PublisherStatisticsResult;
use Wall\Infrastructure\Query\Cache\RedisPublisherStatisticsQuery;
use Wall\Model\PostWasPublished;

class RedisPublisherStatisticsQueryTest extends CacheTestCase
{
    /** @var RedisPublisherStatisticsQuery */
    private $query;

    /** @test */
    public function it_return_empty_statistics_when_none_post_has_been_published()
    {
        $statistics = $this->query->get();

        $this->assertEquals(new PublisherStatisticsResult(0, null), $statistics);
    }

    /** @test */
    public function it_return_statistics()
    {
        $this->given(
            new PostWasPublished(Uuid::uuid4(), 'joan@doe.com', 'Lorem ipsum.', new \DateTime()),
            new PostWasPublished(Uuid::uuid4(), 'joan@doe.com', 'Lorem ipsum.', new \DateTime()),
            new PostWasPublished(Uuid::uuid4(), 'john@doe.com', 'Lorem ipsum.', new \DateTime()),
            new PostWasPublished(Uuid::uuid4(), 'joan@doe.com', 'Lorem ipsum.', new \DateTime()),
            new PostWasPublished(Uuid::uuid4(), 'contact@lzakrzewski.com', 'Lorem ipsum.', new \DateTime()),
            new PostWasPublished(Uuid::uuid4(), 'john@doe.com', 'Lorem ipsum.', new \DateTime()),
            new PostWasPublished(Uuid::uuid4(), 'contact@lzakrzewski.com', 'Lorem ipsum.', new \DateTime())
        );

        $statistics = $this->query->get();

        $this->assertEquals(new PublisherStatisticsResult(7, 'joan@doe.com'), $statistics);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->query = $this->container()->get(PublisherStatisticsQuery::class);
    }

    protected function tearDown()
    {
        $this->query = null;

        parent::tearDown();
    }
}
