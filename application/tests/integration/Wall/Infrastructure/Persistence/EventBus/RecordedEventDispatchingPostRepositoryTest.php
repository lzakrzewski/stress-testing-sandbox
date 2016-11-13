<?php

declare(strict_types=1);

namespace integration\Wall\Infrastructure\Persistence\EventBus;

use Ramsey\Uuid\Uuid;
use tests\integration\IntegrationTestCase;
use tests\Wall\Application\CommandBus\CollectEventsMiddleware;
use Wall\Infrastructure\Persistence\EventBus\RecordedEventDispatchingPostRepository;
use Wall\Model\Post;
use Wall\Model\PostWasPublished;

class RecordedEventDispatchingPostRepositoryTest extends IntegrationTestCase
{
    /** @var RecordedEventDispatchingPostRepository */
    private $repository;

    /** @test */
    public function it_can_record_events_when_post_was_added_to_repository()
    {
        $post = Post::publish(Uuid::uuid4(), 'john@doe.com', 'Lorem ipsum.', new \DateTime('2017-01-01'));

        $this->repository->add($post);

        $this->assertThatEventWasRecorded(PostWasPublished::class);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->repository = $this->container()->get(RecordedEventDispatchingPostRepository::class);
    }

    protected function tearDown()
    {
        $this->repository = null;

        parent::tearDown();
    }

    private function assertThatEventWasRecorded(string $eventClass)
    {
        $events = $this->eventsByClassName($eventClass);

        $this->assertGreaterThanOrEqual(0, count($events), sprintf('Expected at least one event of class %s', $eventClass));
        foreach ($events as $event) {
            $this->assertInstanceOf($eventClass, $event);
        }
    }

    private function eventsByClassName(string $expectedClass)
    {
        return array_filter(
            $this->container()->get(CollectEventsMiddleware::class)->events(),
            function ($event) use ($expectedClass) {
                return $event instanceof $expectedClass;
            }
        );
    }
}
