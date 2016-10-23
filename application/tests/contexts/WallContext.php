<?php

declare(strict_types=1);

namespace tests\contexts;

use Assert\Assertion;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Wall\Application\Command\PublishPost;
use Wall\Model\Post;

class WallContext extends FeatureContext
{
    /**
     * @Given I am a visitor
     */
    public function iAmAVisitor()
    {
    }

    /**
     * @When I publish post with id :postId
     */
    public function iPublishPost(UuidInterface $postId)
    {
        $command = new PublishPost($postId, 'Hello world!', new \DateTime());

        $this->commandBus()->handle($command);
    }

    /**
     * @Then I post with id :postId should be published
     */
    public function iPostShouldBePublished(UuidInterface $postId)
    {
        Assertion::isInstanceOf($this->posts()->get($postId), Post::class);
    }

    /**
     * @Transform :postId
     */
    public function postId($postId): UuidInterface
    {
        return Uuid::fromString($postId);
    }
}
