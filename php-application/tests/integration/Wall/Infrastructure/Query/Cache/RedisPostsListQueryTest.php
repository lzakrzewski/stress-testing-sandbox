<?php

declare(strict_types=1);

namespace tests\integration\Wall\Infrastructure\Query\Cache;

use Ramsey\Uuid\Uuid;
use tests\integration\Wall\CacheTestCase;
use Wall\Application\Query\Result\PostResult;
use Wall\Infrastructure\Query\Cache\RedisPostsListQuery;
use Wall\Model\PostWasPublished;

class RedisPostsListQueryTest extends CacheTestCase
{
    /** @var RedisPostsListQuery */
    private $query;

    /** @test */
    public function it_returns_empty_list_when_no_posts()
    {
        $this->assertEmpty($this->query->get());
    }

    /** @test */
    public function it_returns_list_with_posts()
    {
        $postId1 = Uuid::uuid4();
        $postId2 = Uuid::uuid4();

        $this->given(
            new PostWasPublished($postId1, 'john@doe.com', 'Lorem ipsum1', new \DateTime('2017-01-01')),
            new PostWasPublished($postId2, 'joan@doe.com', 'Lorem ipsum2', new \DateTime('2016-01-01'))
        );

        $postsList = $this->query->get();

        $this->assertEquals([
            new PostResult($postId1->toString(), 'john@doe.com', 'Lorem ipsum1', new \DateTime('2017-01-01')),
            new PostResult($postId2->toString(), 'joan@doe.com', 'Lorem ipsum2', new \DateTime('2016-01-01')),
        ], $postsList);
    }

    /** @test */
    public function it_returns_list_with_descending_order()
    {
        $postId1 = Uuid::uuid4();
        $postId2 = Uuid::uuid4();
        $postId3 = Uuid::uuid4();

        $this->given(
            new PostWasPublished($postId3, 'contact@lzakrzewski.com', 'Lorem ipsum3', new \DateTime('2015-01-01')),
            new PostWasPublished($postId1, 'john@doe.com', 'Lorem ipsum1', new \DateTime('2017-01-01 00:00:01')),
            new PostWasPublished($postId2, 'joan@doe.com', 'Lorem ipsum2', new \DateTime('2017-01-01 00:00:00'))
        );

        $postsList = $this->query->get();

        $this->assertEquals($postId1->toString(), $postsList[0]->postId);
        $this->assertEquals($postId2->toString(), $postsList[1]->postId);
        $this->assertEquals($postId3->toString(), $postsList[2]->postId);
    }

    /** @test */
    public function it_returns_first_1000_elements_on_list()
    {
        $this->givenCountOfPostsWasPublished(1333);

        $postsList = $this->query->get();

        $this->assertCount(1000, $postsList);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->query = $this->container()->get(RedisPostsListQuery::class);
    }

    protected function tearDown()
    {
        $this->query = null;

        parent::tearDown();
    }

    private function givenCountOfPostsWasPublished(int $count)
    {
        for ($postIndex = 1; $postIndex <= $count; ++$postIndex) {
            $this->given(
                new PostWasPublished(
                    Uuid::uuid4(),
                    sprintf('%s@%s.com', uniqid(), uniqid()),
                    uniqid(),
                    (new \DateTime())->modify(sprintf('-%d day', rand(1, 10000)))
                )
            );
        }
    }
}
