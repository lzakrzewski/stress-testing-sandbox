<?php

declare(strict_types=1);

namespace tests\integration\Wall\Infrastructure\Persistence\Cache;

use Ramsey\Uuid\Uuid;
use tests\integration\Wall\Infrastructure\CacheTestCase;
use Wall\Infrastructure\Persistence\Cache\RedisPostRepository;
use Wall\Model\Post;
use Wall\Model\PostDoesNotExist;

class RedisPostRepositoryTest extends CacheTestCase
{
    /** @var RedisPostRepository */
    private $repository;

    /** @test */
    public function it_can_get_post_from_repository_by_post_id()
    {
        $post = Post::publish(Uuid::uuid4(), 'john@doe.com', 'Lorem ipsum.', new \DateTime('2017-01-01'));

        $this->repository->add($post);

        $this->assertEquals($post, $this->repository->get($post->postId()));
    }

    /** @test */
    public function it_fails_when_post_does_not_exist()
    {
        $this->expectException(PostDoesNotExist::class);

        $this->repository->get(Uuid::uuid4());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->repository = $this->container()->get(RedisPostRepository::class);
    }

    protected function tearDown()
    {
        $this->repository = null;

        parent::tearDown();
    }
}
