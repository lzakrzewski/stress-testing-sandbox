<?php

declare(strict_types=1);

namespace tests\integration\Wall\Application\Subscriber;

use Ramsey\Uuid\Uuid;
use Wall\Application\Query\PublisherStatisticsQuery;
use Wall\Application\Query\Result\PublisherStatistics;
use Wall\Model\PostWasPublished;

class UpdatePublisherStatisticsWhenPostWasPublishedTest extends SubscriberTestCase
{
    /** @test */
    public function it_calls_projector_when_post_was_published()
    {
        $this->handle(new PostWasPublished(Uuid::uuid4(), 'john@doe.com', 'Lorem ipsum.', new \DateTime()));

        $this->assertThatPublisherStatisticsProjectorWasCalled();
    }

    private function assertThatPublisherStatisticsProjectorWasCalled()
    {
        $statistics = $this->container()->get(PublisherStatisticsQuery::class)->get();

        $this->assertInstanceOf(PublisherStatistics::class, $statistics);
        $this->assertGreaterThanOrEqual(1, $statistics->postCount);
    }
}
