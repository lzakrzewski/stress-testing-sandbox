<?php

declare(strict_types=1);

namespace tests\contexts;

use Assert\Assertion;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Wall\Application\Command\PublishPost;
use Wall\Application\Query\Result\PostResult;
use Wall\Model\Post;
use Wall\Model\PostWasPublished;

class WallContext extends FeatureContext
{
    /** @var string */
    private $publisher = '';

    /**
     * @Given I am a publisher with email :publisher
     */
    public function iAmAPublisher(string $publisher)
    {
        $this->publisher = $publisher;
    }

    /**
     * @When I publish post with id :postId and content :content
     */
    public function iPublishPostWithIdAndContent(UuidInterface $postId, string $content)
    {
        $this->handle(new PublishPost($postId, $this->publisher, $content));
    }

    /**
     * @Then I should be notified that post was published
     */
    public function iShouldBeNotifiedThatPostWasPublished()
    {
        $this->expectEvent(PostWasPublished::class);
    }

    /**
     * @Then I should be notified that post is invalid
     */
    public function iShouldBeNotifiedThatPostIsInvalid()
    {
        $this->expectException(\InvalidArgumentException::class);
    }

    /**
     * @Then I post with id :postId should be published
     */
    public function iPostShouldBePublished(UuidInterface $postId)
    {
        Assertion::true($this->hasPostPublished($postId));
    }

    /**
     * @Then I post with id :postId should not be published
     */
    public function iPostShouldNotBePublished(UuidInterface $postId)
    {
        Assertion::false($this->hasPostPublished($postId));
    }

    /**
     * @AfterScenario
     */
    public function afterScenario()
    {
        parent::afterScenario();

        $this->publisher = '';
    }

    /**
     * @Transform :postId
     */
    public function postId($postId): UuidInterface
    {
        return Uuid::fromString($postId);
    }

    private function hasPostPublished(UuidInterface $postId)
    {
        $postsWithId = array_filter($this->posts(), function (PostResult $post) use ($postId) {
            return $postId->equals(Uuid::fromString($post->postId));
        });

        return !empty($postsWithId);
    }
}
