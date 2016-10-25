<?php

declare(strict_types=1);

namespace tests\integration\Wall\Http\Controller;

use tests\integration\IntegrationTestCase;
use tests\integration\Wall\Http\TestClient;

abstract class ControllerTestCase extends IntegrationTestCase
{
    /** @var TestClient */
    private $client;

    protected function setUp()
    {
        parent::setUp();

        $this->client = new TestClient();
    }

    protected function tearDown()
    {
        $this->client = null;

        parent::tearDown();
    }

    protected function client(): TestClient
    {
        return $this->client;
    }

    protected function assertThatResponseHasStatus(int $expectedStatus)
    {
        $this->assertEquals($expectedStatus, $this->client()->getResponse()->getStatus());
    }

    protected function assertThatResponseContains(string $expectedString)
    {
        $this->assertContains($expectedString, $this->client()->getResponse()->getContent());
    }
}
