<?php

declare(strict_types=1);

namespace tests\integration\Wall\Infrastructure\Query\Cache;

use tests\integration\Wall\Infrastructure\RequestTestCase;
use Wall\Application\Query\ClientStatisticsQuery;
use Wall\Application\Query\Result\ClientStatisticsResult;
use Wall\Infrastructure\Query\Cache\RedisClientStatisticsQuery;

class RedisClientStatisticsQueryTest extends RequestTestCase
{
    /** @var RedisClientStatisticsQuery */
    private $query;

    /** @test */
    public function it_return_empty_statistics_when_none_post_has_been_published()
    {
        $statistics = $this->query->get();

        $this->assertEquals(new ClientStatisticsResult(null, null), $statistics);
    }

    /** @test */
    public function it_returns_statistics()
    {
        $this->givenRequestsWithUserAgentWereExecuted(
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_1) AppleWebKit/602.2.14 (KHTML, like Gecko) Version/10.0.1 Safari/602.2.14',
            'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36',
            'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/602.2.14 (KHTML, like Gecko) Version/10.0.1 Safari/602.2.14',
            'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36 OPR/41.0.2353.69',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Safari/602.1.50',
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_2) AppleWebKit/602.3.12 (KHTML, like Gecko) Version/10.0.2 Safari/602.3.12',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Safari/602.1.50',
            'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:49.0) Gecko/20100101 Firefox/49.0'
        );

        $statistics = $this->query->get();

        $this->assertEquals(new ClientStatisticsResult('Safari', 'Mac'), $statistics);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->query = $this->container()->get(ClientStatisticsQuery::class);
    }

    protected function tearDown()
    {
        $this->query = null;

        parent::tearDown();
    }
}
