<?php

declare(strict_types=1);

namespace tests\integration\Wall\Infrastructure\Cache;

use Predis\Client as RedisClient;
use Ramsey\Uuid\Uuid;
use tests\integration\IntegrationTestCase;
use Wall\Infrastructure\Cache\RedisPostRepository;
use Wall\Model\Post;

class RedisPostRepositoryTest extends IntegrationTestCase
{
    /** @var RedisPostRepository */
    private $repository;

    /** @var RedisClient */
    private $redis;

    /** @test */
    public function it_can_get_post_from_repository_by_post_id()
    {
        $post = Post::publish(Uuid::uuid4(), 'Lorem ipsum.', new \DateTime('2017-01-01'));

        $this->repository->add($post);

        $this->assertEquals($post, $this->repository->get($post->postId()));
    }

    /** @test */
    public function it_fails_when_post_does_not_exist()
    {
        $this->expectException(\RuntimeException::class);

        $this->repository->get(Uuid::uuid4());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->redis      = $this->container()->get(RedisClient::class);
        $this->repository = $this->container()->get(RedisPostRepository::class);

        $this->redis->flushall();
    }

    protected function tearDown()
    {
        $this->redis      = null;
        $this->repository = null;

        parent::tearDown();
    }
}
