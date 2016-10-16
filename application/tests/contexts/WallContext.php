<?php

declare(strict_types=1);

namespace tests\contexts;

use Ramsey\Uuid\Uuid;
use Wall\Application\Command\AddPostToWall;

class WallContext extends FeatureContext
{
    /**
     * @Given I am a visitor
     */
    public function iAmAVisitor()
    {
    }

    /**
     * @When I add post to a wall
     */
    public function iAddPostToAWall()
    {
        $command = new AddPostToWall(Uuid::uuid4(), 'Hello world!', new \DateTime());

        $this->commandBus()->handle($command);
    }

    /**
     * @Then I should be notified that post was added to a wall
     */
    public function iShouldBeNotifiedThatPostWasAddedToAWall()
    {
    }
}
