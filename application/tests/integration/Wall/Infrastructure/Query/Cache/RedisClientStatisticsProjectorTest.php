<?php

declare(strict_types=1);

namespace tests\integration\Wall\Infrastructure\Query\Cache;

use tests\integration\Wall\Infrastructure\RequestTestCase;

class RedisClientStatisticsProjectorTest extends RequestTestCase
{
    /** @test */
    public function it_projects_client_statistics_when_post_was_published()
    {
        $this->projectRequestWithUserAgent(
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10; rv:33.0) Gecko/20100101 Firefox/33.0'
        );

        $this->assertThatCacheContainsRange('browsers', ['Firefox' => 1]);
        $this->assertThatCacheContainsRange('os', ['Mac' => 1]);
    }

    /** @test */
    public function it_projects_client_statistics_when_post_was_published_with_invalid_user_agent()
    {
        $this->projectRequestWithUserAgent(
            'invalid'
        );

        $this->assertThatCacheContainsRange('browsers', ['unknown' => 1]);
        $this->assertThatCacheContainsRange('os', ['unknown' => 1]);
    }

    /** @test */
    public function it_projects_client_statistics_when_post_was_published_and_a_few_posts_were_already_published()
    {
        $this->givenRequestsWithUserAgentWereExecuted(
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10; rv:33.0) Gecko/20100101 Firefox/33.0',
            'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.85 Safari/537.36'
        );

        $this->projectRequestWithUserAgent(
            'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'
        );

        $this->assertThatCacheContainsRange('browsers', ['Firefox' => 2, 'Chrome' => 1]);
        $this->assertThatCacheContainsRange('os', ['Windows' => 2, 'Mac' => 1]);
    }
}
