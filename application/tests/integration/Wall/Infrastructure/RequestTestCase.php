<?php

declare(strict_types=1);

namespace tests\integration\Wall\Infrastructure;

use Ramsey\Uuid\Uuid;
use tests\Wall\Http\TestServerRequest;
use Wall\Model\PostWasPublished;

abstract class RequestTestCase extends CacheTestCase
{
    protected function givenRequestsWithUserAgentWereExecuted(...$userAgents)
    {
        foreach ($userAgents as $userAgent) {
            $this->projectRequestWithUserAgent($userAgent);
        }
    }

    protected function projectRequestWithUserAgent(string $userAgent)
    {
        TestServerRequest::mockUserAgent($userAgent);

        $this->handle(new PostWasPublished(Uuid::uuid4(), 'john@doe.com', 'Lorem ipsum.', new \DateTime()));

        TestServerRequest::resetMockedUserAgent();
    }
}
