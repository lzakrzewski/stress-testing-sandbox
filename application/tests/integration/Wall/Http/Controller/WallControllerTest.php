<?php

declare(strict_types=1);

namespace tests\integration\Wall\Http\Controller;

use tests\integration\IntegrationTestCase;

class WallControllerTest extends IntegrationTestCase
{
    /** @test */
    public function it_can_render_wall()
    {
        $this->client()->request('GET', '/');

        $this->assertThatResponseHasStatus(200);
        $this->assertThatResponseContains('Hello world!');
    }
}
