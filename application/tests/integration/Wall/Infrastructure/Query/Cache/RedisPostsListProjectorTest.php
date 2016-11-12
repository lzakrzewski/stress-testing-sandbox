<?php

declare(strict_types=1);

namespace tests\integration\Wall\Infrastructure\Query\Cache;

use Ramsey\Uuid\Uuid;
use tests\integration\Wall\Infrastructure\CacheTestCase;
use Wall\Infrastructure\Query\Cache\RedisPostsListProjector;
use Wall\Model\PostWasPublished;

class RedisPostsListProjectorTest extends CacheTestCase
{
    /** @var RedisPostsListProjector */
    private $projector;

    /** @test */
    public function it_applies_that_post_was_published()
    {
        $this->markTestIncomplete();

        $postId = Uuid::uuid4();

        $this->projector->applyThatPostWasPublished(
            new PostWasPublished($postId, 'john@doe.com', 'Lorem ipsum.', new \DateTime('2017-01-01'))
        );

        $this->assertThatCacheContainsOnKey(
            'posts-list.post:'.$postId->toString(),
            [
                'postId'    => $postId->toString(),
                'publisher' => 'john@doe.com',
                'content'   => 'Lorem ipsum.',
                'at'        => '2017-01-01',
            ]
        );
    }

    protected function setUp()
    {
        parent::setUp();

        $this->projector = $this->container()->get(RedisPostsListProjector::class);
    }

    protected function tearDown()
    {
        $this->projector = null;

        parent::tearDown();
    }
}
