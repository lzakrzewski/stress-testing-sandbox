<?php

declare(strict_types=1);

namespace tests\integration\Wall\Infrastructure\Query\Cache;

use DeviceDetector\DeviceDetector;
use Predis\Client as RedisClient;
use Psr\Http\Message\ServerRequestInterface;
use tests\integration\Wall\Infrastructure\CacheTestCase;
use Wall\Application\Query\ClientStatisticsQuery;
use Wall\Application\Query\Result\ClientStatistics;
use Wall\Infrastructure\Query\Cache\RedisClientStatisticsProjector;
use Wall\Infrastructure\Query\Cache\RedisClientStatisticsQuery;
use Zend\Diactoros\ServerRequest;

class RedisClientStatisticsQueryTest extends CacheTestCase
{
    /** @var RedisClientStatisticsQuery */
    private $query;

    /** @test */
    public function it_return_empty_statistics_when_none_post_has_been_published()
    {
        $statistics = $this->query->get();

        $this->assertEquals(new ClientStatistics(null, null), $statistics);
    }

    /** @test */
    public function it_returns_statistics()
    {
        $this->given(
            $this->requestWithUserAgent(
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10; rv:33.0) Gecko/20100101 Firefox/33.0'
            ),
            $this->requestWithUserAgent(
                'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.85 Safari/537.36'
            ),
            $this->requestWithUserAgent(
                'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'
            )
        );

        $statistics = $this->query->get();

        $this->assertEquals(new ClientStatistics('Firefox', 'Windows'), $statistics);
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

    private function requestWithUserAgent(string $userAgent): ServerRequestInterface
    {
        return (new ServerRequest([], [], 'http://localhost/publish-post', 'POST'))
            ->withHeader('user-agent', [$userAgent]);
    }

    private function given(...$requests)
    {
        foreach ($requests as $request) {
            $projector = new RedisClientStatisticsProjector(
                $this->container()->get(RedisClient::class),
                $this->container()->get(DeviceDetector::class),
                $request
            );

            $projector->applyThatPostWasPublished();
        }
    }
}
