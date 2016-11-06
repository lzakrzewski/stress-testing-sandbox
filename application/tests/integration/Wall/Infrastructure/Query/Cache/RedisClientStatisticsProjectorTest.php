<?php

declare(strict_types=1);

namespace tests\integration\Wall\Infrastructure\Query\Cache;

use DeviceDetector\DeviceDetector;
use Predis\Client as RedisClient;
use Psr\Http\Message\ServerRequestInterface;
use tests\integration\Wall\Infrastructure\CacheTestCase;
use Wall\Infrastructure\Query\Cache\RedisClientStatisticsProjector;
use Zend\Diactoros\ServerRequest;

class RedisClientStatisticsProjectorTest extends CacheTestCase
{
    /** @test */
    public function it_applies_when_post_was_created_when_no_posts()
    {
        $this->applyThatPostWasPublishedDuringRequest(
            $this->requestWithUserAgent(
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10; rv:33.0) Gecko/20100101 Firefox/33.0'
            )
        );

        $this->assertThatCacheContainsSetOnKey('os', ['Mac']);
        $this->assertThatCacheContainsSetOnKey('browsers', ['Firefox']);
        $this->assertThatCacheContainsOnKey('os_Mac', 1);
        $this->assertThatCacheContainsOnKey('browser_Firefox', 1);
    }

    /** @test */
    public function it_applies_when_post_was_created_when_a_few_posts_were_already_published()
    {
        $this->applyThatPostWasPublishedDuringRequest(
            $this->requestWithUserAgent(
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10; rv:33.0) Gecko/20100101 Firefox/33.0'
            )
        );

        $this->applyThatPostWasPublishedDuringRequest(
            $this->requestWithUserAgent(
                'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.85 Safari/537.36'
            )
        );

        $this->applyThatPostWasPublishedDuringRequest(
            $this->requestWithUserAgent(
                'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'
            )
        );

        $this->assertThatCacheContainsSetOnKey('os', ['Mac', 'Windows']);
        $this->assertThatCacheContainsSetOnKey('browsers', ['Firefox', 'Chrome']);
        $this->assertThatCacheContainsOnKey('os_Mac', 1);
        $this->assertThatCacheContainsOnKey('os_Windows', 2);
        $this->assertThatCacheContainsOnKey('browser_Firefox', 2);
        $this->assertThatCacheContainsOnKey('browser_Chrome', 1);
    }

    private function applyThatPostWasPublishedDuringRequest(ServerRequestInterface $request)
    {
        $projector = new RedisClientStatisticsProjector(
            $this->container()->get(RedisClient::class),
            $this->container()->get(DeviceDetector::class),
            $request
        );

        $projector->applyThatPostWasPublished();
    }

    private function requestWithUserAgent(string $userAgent): ServerRequestInterface
    {
        return (new ServerRequest([], [], 'http://localhost/publish-post', 'POST'))
            ->withHeader('user-agent', [$userAgent]);
    }
}
