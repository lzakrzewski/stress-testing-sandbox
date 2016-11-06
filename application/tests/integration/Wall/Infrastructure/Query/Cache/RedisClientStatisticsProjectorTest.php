<?php

declare(strict_types=1);

namespace tests\integration\Wall\Infrastructure\Query\Cache;

use Psr\Http\Message\ServerRequestInterface;
use tests\integration\Wall\Infrastructure\CacheTestCase;
use tests\integration\Wall\Infrastructure\Query\Cache\Dictionary\ClientStatisticsDictionary;
use Wall\Infrastructure\Query\Cache\RedisClientStatisticsProjector;

class RedisClientStatisticsProjectorTest extends CacheTestCase
{
    use ClientStatisticsDictionary;

    /** @test */
    public function it_projects_client_statistics_when_post_was_published()
    {
        $this->projectWithRequest(
            $this->requestWithUserAgent(
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10; rv:33.0) Gecko/20100101 Firefox/33.0'
            )
        );

        $this->assertThatCacheContainsSetOnKey(RedisClientStatisticsProjector::OS_KEY, ['Mac']);
        $this->assertThatCacheContainsSetOnKey(RedisClientStatisticsProjector::BROWSERS_KEY, ['Firefox']);
        $this->assertThatCacheContainsOnKey($this->osKey('Mac'), 1);
        $this->assertThatCacheContainsOnKey($this->browserKey('Firefox'), 1);
    }

    /** @test */
    public function it_projects_client_statistics_when_post_was_published_with_invalid_user_agent()
    {
        $this->projectWithRequest(
            $this->requestWithUserAgent(
                'invalid'
            )
        );

        $this->assertThatCacheContainsSetOnKey(RedisClientStatisticsProjector::OS_KEY, ['unknown']);
        $this->assertThatCacheContainsSetOnKey(RedisClientStatisticsProjector::BROWSERS_KEY, ['unknown']);
        $this->assertThatCacheContainsOnKey($this->osKey('unknown'), 1);
        $this->assertThatCacheContainsOnKey($this->browserKey('unknown'), 1);
    }

    /** @test */
    public function it_projects_client_statistics_when_post_was_published_and_a_few_posts_were_already_published()
    {
        $this->given(
            $this->requestWithUserAgent(
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10; rv:33.0) Gecko/20100101 Firefox/33.0'
            ),
            $this->requestWithUserAgent(
                'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.85 Safari/537.36'
            )
        );

        $this->projectWithRequest(
            $this->requestWithUserAgent(
                'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'
            )
        );

        $this->assertThatCacheContainsSetOnKey(RedisClientStatisticsProjector::OS_KEY, ['Mac', 'Windows']);
        $this->assertThatCacheContainsSetOnKey(RedisClientStatisticsProjector::BROWSERS_KEY, ['Firefox', 'Chrome']);
        $this->assertThatCacheContainsOnKey($this->osKey('Windows'), 2);
        $this->assertThatCacheContainsOnKey($this->browserKey('Firefox'), 2);
        $this->assertThatCacheContainsOnKey($this->osKey('Mac'), 1);
        $this->assertThatCacheContainsOnKey($this->browserKey('Chrome'), 1);
    }

    private function projectWithRequest(ServerRequestInterface $request)
    {
        $this->given($request);
    }

    private function osKey(string $os): string
    {
        return sprintf(sprintf(RedisClientStatisticsProjector::OS_KEY_PATTERN, $os));
    }

    private function browserKey($browser): string
    {
        return sprintf(sprintf(RedisClientStatisticsProjector::BROWSER_KEY_PATTERN, $browser));
    }
}
