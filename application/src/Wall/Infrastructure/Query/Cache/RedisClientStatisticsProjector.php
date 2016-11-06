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
    const OS_KEY         = 'os';
    const OS_KEY_PATTERN = 'os_%s';

    const BROWSERS_KEY        = 'browsers';
    const BROWSER_KEY_PATTERN = 'browser_%s';

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
        $pipeline->sadd(self::OS_KEY, $os = $this->detectOs());

        $osCount = $this->osCount($os);

        $pipeline->set($this->osKey($os), ++$osCount);

        return $pipeline;
    }

    private function projectBrowser(Pipeline $pipeline): Pipeline
    {
        $pipeline->sadd(self::BROWSERS_KEY, $browser = $this->detectBrowser());

        $browserCount = $this->browserCount($browser);

        $pipeline->set($this->browserKey($browser), ++$browserCount);

        return $pipeline;
    }

    private function detectOs(): string
    {
        $osData = $this->detector->getOs();

        if (!isset($osData['name'])) {
            return 'unknown';
        }

        return $osData['name'];
    }

    private function osCount($os): int
    {
        $osCount = $this->redis->get($this->osKey($os));

        if (null === $osCount) {
            return 0;
        }

        return (int) $osCount;
    }

    private function osKey($os): string
    {
        return sprintf(self::OS_KEY_PATTERN, $os);
    }

    private function browserCount($browser): int
    {
        $browserCount = $this->redis->get($this->browserKey($browser));

        if (null === $browserCount) {
            return 0;
        }

        return (int) $browserCount;
    }

    private function browserKey($browser): string
    {
        return sprintf(self::BROWSER_KEY_PATTERN, $browser);
    }

    private function detectBrowser()
    {
        $browserData = $this->detector->getClient();

        if (!isset($browserData['name'])) {
            return 'unknown';
        }

        return $browserData['name'];
    }
}
