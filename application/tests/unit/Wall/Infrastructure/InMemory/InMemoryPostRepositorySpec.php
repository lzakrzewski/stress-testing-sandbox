<?php

declare(strict_types=1);

namespace tests\unit\Wall\Infrastructure\InMemory;

use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;
use Wall\Infrastructure\InMemory\InMemoryPostRepository;
use Wall\Model\Post;

/** @mixin InMemoryPostRepository */
class InMemoryPostRepositorySpec extends ObjectBehavior
{
    public function let()
    {
        $this->beAnInstanceOf(InMemoryPostRepository::class);
    }

    public function it_can_get_post_from_repository_by_post_id()
    {
        $post = Post::publish(Uuid::uuid4(), 'Lorem ipsum.', new \DateTime('2017-01-01'));

        $this->add($post);

        $this->get($post->postId())->shouldBeLike($post);
    }

    public function it_fails_when_post_does_not_exist()
    {
        $this->shouldThrow(\RuntimeException::class)->during('get', [Uuid::uuid4()]);
    }
}
