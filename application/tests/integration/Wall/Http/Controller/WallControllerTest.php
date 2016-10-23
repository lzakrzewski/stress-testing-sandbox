<?php

declare(strict_types=1);

namespace tests\integration\Wall\Http\Controller;

use tests\integration\IntegrationTestCase;

class WallControllerTest extends IntegrationTestCase
{
    /** @test */
    public function it_can_render_wall_with_posts()
    {
        $this->client()->request('GET', '/');

        $this->assertThatResponseHasStatus(200);
        $this->assertThatResponseContains('Wall');
    }

    /** @test */
    public function it_can_publish_post()
    {
        $this->client()->request('POST', '/', ['content' => 'Lorem ipsum']);

        $this->assertThatResponseHasStatus(201);
        $this->assertThatResponseContains('Post created!');
    }

    /** @test */
    public function it_can_not_publish_post_with_invalid_data()
    {
        $this->client()->request('POST', '/');

        $this->assertThatResponseHasStatus(400);
        $this->assertThatResponseContains('Error:');
    }
}
