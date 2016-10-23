<?php

declare(strict_types=1);

namespace tests\integration\Wall\Http\Controller;

use tests\integration\IntegrationTestCase;

//Todo: add post
class WallControllerTest extends IntegrationTestCase
{
    /** @test */
    public function it_can_render_wall_with_posts()
    {
        $this->client()->request('GET', '/');

        $this->assertThatResponseHasStatus(200);
        $this->assertThatResponseContains('Hello world!');
    }

    /** @test */
    public function it_can_publish_post()
    {
        $this->client()->request('POST', '/');

        $this->assertThatResponseHasStatus(201);
    }
}
