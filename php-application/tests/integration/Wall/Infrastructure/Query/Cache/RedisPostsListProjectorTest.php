<?php

declare(strict_types=1);

namespace tests\integration\Wall\Infrastructure\Query\Cache;

use Ramsey\Uuid\Uuid;
use tests\integration\Wall\CacheTestCase;
use Wall\Infrastructure\Query\Cache\RedisPostsListProjector;
use Wall\Model\PostWasPublished;

class RedisPostsListProjectorTest extends CacheTestCase
{
    /** @var RedisPostsListProjector */
    private $projector;

    /** @test */
    public function it_applies_that_post_was_published()
    {
        $postId = Uuid::fromString('8cf8d826-fe7f-4298-b080-883144acb026');

        $this->projector->applyThatPostWasPublished(
            new PostWasPublished($postId, 'john@doe.com', 'Lorem ipsum.', new \DateTime('2017-01-01 00:00:00'))
        );

        $this->assertThatCacheContains(
            'post:8cf8d826-fe7f-4298-b080-883144acb026',
            [
                'postId'    => '8cf8d826-fe7f-4298-b080-883144acb026',
                'publisher' => 'john@doe.com',
                'content'   => 'Lorem ipsum.',
                'at'        => '2017-01-01 00:00:00',
            ]
        );
        $this->assertThatCacheContainsRange('posts', ['post:8cf8d826-fe7f-4298-b080-883144acb026' => '1483228800']);
    }

    /** @test */
    public function it_applies_that_post_was_published_when_a_few_posts_already_published()
    {
        $this->given(
            new PostWasPublished(
                Uuid::fromString('21089894-1916-4005-b12f-751de926595b'),
                'john@doe.com',
                'Lorem ipsum.',
                new \DateTime('2015-01-01 00:00:00')
            ),
            new PostWasPublished(
                Uuid::fromString('073fd513-497c-4fff-9f1c-79ea8bef44b8'),
                'joan@doe.com',
                'Lorem ipsum.',
                new \DateTime('2016-01-01 00:00:00')
            ),
            new PostWasPublished(
                Uuid::fromString('0cc76d39-765c-4bd4-aad5-a79a0127c244'),
                'contact@lzakrzewski.com',
                'Lorem ipsum.',
                new \DateTime('2018-01-01 00:00:00')
            )
        );

        $postId = Uuid::fromString('8cf8d826-fe7f-4298-b080-883144acb026');

        $this->projector->applyThatPostWasPublished(
            new PostWasPublished($postId, 'john@doe.com', 'Lorem ipsum.', new \DateTime('2017-01-01 00:00:00'))
        );

        $this->assertThatCacheContains(
            'post:8cf8d826-fe7f-4298-b080-883144acb026',
            [
                'postId'    => '8cf8d826-fe7f-4298-b080-883144acb026',
                'publisher' => 'john@doe.com',
                'content'   => 'Lorem ipsum.',
                'at'        => '2017-01-01 00:00:00',
            ]
        );
        $this->assertThatCacheContainsRange(
            'posts',
            [
                'post:8cf8d826-fe7f-4298-b080-883144acb026' => '1483228800',
                'post:0cc76d39-765c-4bd4-aad5-a79a0127c244' => '1514764800',
                'post:073fd513-497c-4fff-9f1c-79ea8bef44b8' => '1451606400',
                'post:21089894-1916-4005-b12f-751de926595b' => '1420070400',
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
