<?php

declare(strict_types=1);

namespace tests\integration\Wall\Infrastructure;

use Assert\Assertion;
use Predis\Client as RedisClient;
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
            $this->container()->get('event_bus')->handle($event);
        }
    }

    protected function assertThatCacheContainsSetOnKey(string $key, array $expectedMembers)
    {
        $members = $this->redis->smembers($key);

        sort($expectedMembers);
        sort($members);

        $this->assertEquals($expectedMembers, $members);
    }

    protected function assertThatCacheContainsOnKey(string $key, $expectedCacheContents)
    {
        $contents = $this->redis->get($key);

        $this->assertEquals($expectedCacheContents, $this->deserialize($contents));
    }

    private function deserialize($contents)
    {
        return json_decode($contents, true);
    }
}
