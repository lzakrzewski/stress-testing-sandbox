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

    public function applyThatPostWasPublished()
    {
        $this->parseUserAgent();

        $pipeline = $this->redis->pipeline();

        $pipeline = $this->applyOs($pipeline);
        $pipeline = $this->applyBrowser($pipeline);

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

    private function applyOs(Pipeline $pipeline): Pipeline
    {
        $osData = $this->detector->getOs();

        if (!isset($osData['name'])) {
            return $pipeline;
        }

        $os = $osData['name'];

        $pipeline->sadd('os', $os);

        $osCount = $this->redis->get(sprintf('os_%s', $os));

        if (empty($osCount)) {
            $osCount = 0;
        }

        $pipeline->set(sprintf('os_%s', $os), ++$osCount);

        return $pipeline;
    }

    private function applyBrowser(Pipeline $pipeline): Pipeline
    {
        $browserData = $this->detector->getClient();

        if (!isset($browserData['name'])) {
            return $pipeline;
        }

        $browser = $browserData['name'];

        $pipeline->sadd('browsers', $browser);

        $browserCount = $this->redis->get(sprintf('browser_%s', $browser));

        if (empty($browserCount)) {
            $browserCount = 0;
        }

        $pipeline->set(sprintf('browser_%s', $browser), ++$browserCount);

        return $pipeline;
    }
}
