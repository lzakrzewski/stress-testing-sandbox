<?php

declare(strict_types=1);

namespace tests\integration\Wall\Infrastructure;

use Assert\Assertion;
use Predis\Client as RedisClient;
use SimpleBus\Message\Bus\MessageBus;
use tests\integration\IntegrationTestCase;
use Wall\Model\PostWasPublished;

abstract class CacheTestCase extends IntegrationTestCase
{
    /** @var RedisClient */
    private $redis;

    protected function setUp()
    {
        parent::setUp();

        $this->redis = $this->container()->get(RedisClient::class);
        $this->redis->flushall();
    }

    protected function tearDown()
    {
        $this->redis = null;

        parent::tearDown();
    }

    protected function given(...$events)
    {
        foreach ($events as $event) {
            Assertion::isInstanceOf($event, PostWasPublished::class);
            $this->eventBus()->handle($event);
        }
    }

    protected function assertThatCacheContains(string $key, array $expectedValue)
    {
        $contents = $this->redis->get($key);

        $this->assertNotNull($contents);
        $this->assertEquals($expectedValue, $this->deserialize($contents));
    }

    protected function assertThatCacheContainsRange(string $key, array $expectedMembers)
    {
        $rank = $this->redis->zrevrange($key, 0, -1, 'WITHSCORES');

        $this->assertNotNull($rank);
        $this->assertEquals($expectedMembers, $rank);
    }

    private function deserialize($contents)
    {
        return json_decode($contents, true);
    }

    private function eventBus(): MessageBus
    {
        return $this->container()->get('event_bus');
    }
}
