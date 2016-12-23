<?php

declare(strict_types=1);

namespace tests\integration\Wall\Http\Controller;

use Ramsey\Uuid\Uuid;
use Wall\Model\PostWasPublished;

class WallControllerTest extends ControllerTestCase
{
    /** @test */
    public function it_can_render_wall_with_posts()
    {
        $this->given(
            new PostWasPublished(Uuid::uuid4(), 'john@doe.com', 'Already published post.', new \DateTime())
        );

        $this->client()->request('GET', '/');

        $this->assertThatResponseHasStatus(200);
        $this->assertThatResponseContains('Wall');
        $this->assertThatResponseContains('Already published post.');
    }

    /** @test */
    public function it_can_publish_post()
    {
        $this->given(
            new PostWasPublished(Uuid::uuid4(), 'john@doe.com', 'Already published post.', new \DateTime())
        );

        $this->client()->request('POST', '/', ['publisher' => 'john@doe.com', 'content' => 'Freshly published post!']);

        $this->assertThatResponseHasStatus(201);
        $this->assertThatResponseContains('Post created!');
        $this->assertThatResponseContains('Freshly published post!');
        $this->assertThatResponseContains('Already published post.');
    }

    /** @test */
    public function it_can_not_publish_post_with_invalid_data()
    {
        $this->given(
            new PostWasPublished(Uuid::uuid4(), 'john@doe.com', 'Already published post.', new \DateTime())
        );

        $this->client()->request('POST', '/');

        $this->assertThatResponseHasStatus(400);
        $this->assertThatResponseContains('Error:');
        $this->assertThatResponseContains('Already published post.');
    }
}
