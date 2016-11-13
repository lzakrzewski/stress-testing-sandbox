<?php

declare(strict_types=1);

namespace integration\Wall\Infrastructure\Query\Cache;

use Ramsey\Uuid\Uuid;
use tests\integration\Wall\Infrastructure\CacheTestCase;
use Wall\Infrastructure\Query\Cache\RedisPublisherStatisticsProjector;
use Wall\Model\PostWasPublished;

class RedisPublisherStatisticsProjectorTest extends CacheTestCase
{
    /** @var RedisPublisherStatisticsProjector */
    private $projector;

    /** @test */
    public function it_applies_that_post_was_published()
    {
        $this->projector->applyThatPostWasPublished(
            new PostWasPublished(Uuid::uuid4(), 'john@doe.com', 'Lorem ipsum.', new \DateTime('2017-01-01'))
        );

        $this->assertThatCacheContainsRange('publishers', ['john@doe.com' => 1]);
    }

    /** @test */
    public function it_applies_that_post_was_published_when_a_few_posts_were_already_published()
    {
        $this->given(
            new PostWasPublished(Uuid::uuid4(), 'john@doe.com', 'Lorem ipsum 1.', new \DateTime('2017-01-01')),
            new PostWasPublished(Uuid::uuid4(), 'john@doe.com', 'Lorem ipsum 2.', new \DateTime('2017-01-01')),
            new PostWasPublished(Uuid::uuid4(), 'joan@doe.com', 'Lorem ipsum 1.', new \DateTime('2017-01-01')),
            new PostWasPublished(Uuid::uuid4(), 'contact@lzakrzewski.com', 'Lorem ipsum 1.', new \DateTime('2017-01-01'))
        );

        $this->projector->applyThatPostWasPublished(
            new PostWasPublished(Uuid::uuid4(), 'john@doe.com', 'Lorem ipsum 3.', new \DateTime('2017-01-01'))
        );

        $this->assertThatCacheContainsRange(
            'publishers',
            [
                'john@doe.com'            => 3,
                'joan@doe.com'            => 1,
                'contact@lzakrzewski.com' => 1,
            ]
        );
    }

    protected function setUp()
    {
        parent::setUp();

        $this->projector = $this->container()->get(RedisPublisherStatisticsProjector::class);
    }

    protected function tearDown()
    {
        $this->projector = null;

        parent::tearDown();
    }
}
