<?php

declare(strict_types=1);

namespace Wall\Application\Command;

final class AddPostToWallHandler
{
    public function handle(AddPostToWall $addPostToWall)
    {
        var_dump($addPostToWall);
    }
}
