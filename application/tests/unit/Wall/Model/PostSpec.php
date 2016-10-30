<?php

declare(strict_types=1);

namespace tests\unit\Wall\Model;

use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Wall\Model\Post;
use Wall\Model\PostWasPublished;

/** @mixin Post */
class PostSpec extends ObjectBehavior
{
    public function it_can_be_published()
    {
        $this->beConstructedThrough(
            'publish',
            [
                Uuid::uuid4(),
                'john@doe.com',
                'Lorem ipsum.',
                new \DateTime('2017-01-01'),
            ]
        );

        $this->postId()->shouldBeAnInstanceOf(UuidInterface::class);
        $this->publisher()->shouldBe('john@doe.com');
        $this->content()->shouldBe('Lorem ipsum.');
        $this->at()->shouldBeLike(new \DateTime('2017-01-01'));
    }

    public function it_can_be_published_with_empty_content()
    {
        $this->beConstructedThrough('publish', [Uuid::uuid4(), 'john@doe.com', '', new \DateTime('2017-01-01')]);

        $this->shouldThrow(\InvalidArgumentException::class)->duringInstantiation();
    }

    public function it_can_be_published_with_empty_publisher()
    {
        $this->beConstructedThrough('publish', [Uuid::uuid4(), '', 'Lorem ipsum.', new \DateTime('2017-01-01')]);

        $this->shouldThrow(\InvalidArgumentException::class)->duringInstantiation();
    }

    public function it_can_be_published_with_invalid_publisher()
    {
        $this->beConstructedThrough('publish', [Uuid::uuid4(), 'invalid', 'Lorem ipsum.', new \DateTime('2017-01-01')]);

        $this->shouldThrow(\InvalidArgumentException::class)->duringInstantiation();
    }

    public function it_has_events()
    {
        $postId = Uuid::uuid4();

        $this->beConstructedThrough(
            'publish',
            [
                $postId,
                'john@doe.com',
                'Lorem ipsum.',
                new \DateTime('2017-01-01'),
            ]
        );

        $this->events()->shouldBeLike(
            [
                new PostWasPublished($postId, 'john@doe.com', 'Lorem ipsum.', new \DateTime('2017-01-01')),
            ]
        );
    }
}
