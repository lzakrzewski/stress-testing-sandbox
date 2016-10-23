<?php

declare(strict_types=1);

namespace tests\unit\Wall\Model;

use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Wall\Model\Post;

/** @mixin Post */
class PostSpec extends ObjectBehavior
{
    public function it_can_be_published()
    {
        $this->beConstructedThrough('publish', [Uuid::uuid4(), 'Lorem ipsum.', new \DateTime('2017-01-01')]);

        $this->postId()->shouldBeAnInstanceOf(UuidInterface::class);
        $this->content()->shouldBe('Lorem ipsum.');
        $this->at()->shouldBeLike(new \DateTime('2017-01-01'));
    }

    public function it_can_be_published_with_empty_content()
    {
        $this->beConstructedThrough('publish', [Uuid::uuid4(), '', new \DateTime('2017-01-01')]);

        $this->shouldThrow(\InvalidArgumentException::class)->duringInstantiation();
    }
}
