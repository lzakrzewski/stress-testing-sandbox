<?php

declare(strict_types=1);

namespace integration\Wall\Infrastructure\Query\Cache;

use Ramsey\Uuid\Uuid;
use tests\integration\Wall\Infrastructure\CacheTestCase;
use tests\integration\Wall\Infrastructure\Query\Cache\Dictionary\PublisherStatisticsDictionary;
use Wall\Infrastructure\Query\Cache\RedisPublisherStatisticsProjector;
use Wall\Model\PostWasPublished;

class RedisPublisherStatisticsProjectorTest extends CacheTestCase
{
    use PublisherStatisticsDictionary;

    /** @var RedisPublisherStatisticsProjector */
    private $projector;

    /** @test */
    public function it_applies_that_post_was_published()
    {
        $postId = Uuid::uuid4();

        $this->projector->applyThatPostWasPublished(
            new PostWasPublished($postId, 'john@doe.com', 'Lorem ipsum.', new \DateTime('2017-01-01'))
        );

        $this->assertThatCacheContainsSetOnKey(RedisPublisherStatisticsProjector::PUBLISHERS_KEY, ['john@doe.com']);
        $this->assertThatCacheContainsOnKey($this->publisherKey('john@doe.com'), 1);
        $this->assertThatCacheContainsSetOnKey(RedisPublisherStatisticsProjector::POSTS_KEY, [$postId->toString()]);
    }

    /** @test */
    public function it_applies_that_post_was_published_when_a_few_posts_were_already_published()
    {
        $postId1 = Uuid::uuid4();
        $postId2 = Uuid::uuid4();
        $postId3 = Uuid::uuid4();
        $postId4 = Uuid::uuid4();

        $this->given(
            new PostWasPublished($postId1, 'john@doe.com', 'Lorem ipsum.', new \DateTime('2017-01-01')),
            new PostWasPublished($postId2, 'joan@doe.com', 'Lorem ipsum.', new \DateTime('2017-01-01')),
            new PostWasPublished($postId3, 'contact@lzakrzewski.com', 'Lorem ipsum.', new \DateTime('2017-01-01'))
        );

        $this->projector->applyThatPostWasPublished(
            new PostWasPublished($postId4, 'john@doe.com', 'Lorem ipsum.', new \DateTime('2017-01-01'))
        );

        $this->assertThatCacheContainsSetOnKey(RedisPublisherStatisticsProjector::PUBLISHERS_KEY, ['john@doe.com', 'joan@doe.com', 'contact@lzakrzewski.com']);
        $this->assertThatCacheContainsOnKey($this->publisherKey('john@doe.com'), 2);
        $this->assertThatCacheContainsOnKey($this->publisherKey('joan@doe.com'), 1);
        $this->assertThatCacheContainsOnKey($this->publisherKey('contact@lzakrzewski.com'), 1);
        $this->assertThatCacheContainsSetOnKey(
            RedisPublisherStatisticsProjector::POSTS_KEY,
            [
                $postId1->toString(),
                $postId2->toString(),
                $postId3->toString(),
                $postId4->toString(),
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

    private function publisherKey(string $publisher): string
    {
        return sprintf(RedisPublisherStatisticsProjector::PUBLISHER_KEY_PATTERN, $publisher);
    }
}
