<?php

declare(strict_types=1);

namespace tests\integration;

use PHPUnit\Framework\TestCase;

abstract class IntegrationTestCase extends TestCase
{
    /** @var Client */
    private $client;

    protected function setUp()
    {
        $this->client = new Client();
    }

    protected function tearDown()
    {
        $this->client = null;
    }

    protected function client(): Client
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
