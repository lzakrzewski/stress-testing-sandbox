<?php

declare(strict_types=1);

namespace Wall\Infrastructure\Query\Cache;

use DeviceDetector\DeviceDetector;
use Predis\Client as RedisClient;
use Predis\Pipeline\Pipeline;
use Psr\Http\Message\ServerRequestInterface;
use Wall\Application\Query\ClientStatisticsProjector;

class RedisClientStatisticsProjector implements ClientStatisticsProjector
{
    const OS_KEY       = 'os';
    const BROWSERS_KEY = 'browsers';
    const UNKNOWN      = 'unknown';

    /** @var RedisClient */
    private $redis;

    /** @var ServerRequestInterface */
    private $request;

    /** @var DeviceDetector */
    private $detector;

    public function __construct(RedisClient $redis, DeviceDetector $detector, ServerRequestInterface $request)
    {
        $this->redis    = $redis;
        $this->detector = $detector;
        $this->request  = $request;
    }

    public function project()
    {
        $this->parseUserAgent();

        $pipeline = $this->redis->pipeline();

        $pipeline = $this->projectOs($pipeline);
        $pipeline = $this->projectBrowser($pipeline);

        $pipeline->execute();
    }

    private function parseUserAgent()
    {
        $headers = $this->request->getHeader('user-agent');

        if (empty($headers)) {
            return;
        }

        $this->detector->setUserAgent($headers[0]);
        $this->detector->parse();
    }

    private function projectOs(Pipeline $pipeline): Pipeline
    {
        $os      = $this->detectOs();
        $osCount = $this->osScore($os);

        $pipeline->zadd(self::OS_KEY, ++$osCount, $os);

        return $pipeline;
    }

    private function osScore(string $os): int
    {
        $osScore = $this->redis->zscore(self::OS_KEY, $os);

        if (null === $osScore) {
            return 0;
        }

        return (int) $osScore;
    }

    private function projectBrowser(Pipeline $pipeline): Pipeline
    {
        $browser      = $this->detectBrowser();
        $browserScore = $this->browserScore($browser);

        $pipeline->zadd(self::BROWSERS_KEY, ++$browserScore, $browser);

        return $pipeline;
    }

    private function browserScore(string $browser): int
    {
        $browserScore = $this->redis->zscore(self::BROWSERS_KEY, $browser);

        if (null === $browserScore) {
            return 0;
        }

        return (int) $browserScore;
    }

    private function detectOs(): string
    {
        $osData = $this->detector->getOs();

        if (!isset($osData['name'])) {
            return self::UNKNOWN;
        }

        return $osData['name'];
    }

    private function detectBrowser()
    {
        $browserData = $this->detector->getClient();

        if (!isset($browserData['name'])) {
            return self::UNKNOWN;
        }

        return $browserData['name'];
    }
}
