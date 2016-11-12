<?php

declare(strict_types=1);

namespace Wall\Infrastructure\Persistence\Cache;

use Predis\Client as RedisClient;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Wall\Model\Post;
use Wall\Model\PostDoesNotExist;
use Wall\Model\PostRepository;

//Todo: RecordedEventDispatchingPostRepository
class RedisPostRepository implements PostRepository
{
    /** @var RedisClient */
    private $redis;

    public function __construct(RedisClient $redis)
    {
        $this->redis = $redis;
    }

    public function add(Post $post)
    {
        $postData = $this->serialize($post);

        $this->redis->set($post->postId()->toString(), $postData);
    }

    public function get(UuidInterface $postId): Post
    {
        $content = $this->redis->get($postId->toString());

        if (empty($content)) {
            throw new PostDoesNotExist(sprintf('Post with id %s does not exist.', $postId->toString()));
        }

        return $this->deserialize($content);
    }

    private function serialize(Post $post): string
    {
        return json_encode([
            'postId'    => $post->postId()->toString(),
            'publisher' => $post->publisher(),
            'content'   => $post->content(),
            'at'        => $post->at()->format('Y-m-d H:i:s'),
        ]);
    }

    private function deserialize($content): Post
    {
        $postData = json_decode($content, true);

        return Post::publish(
            Uuid::fromString($postData['postId']),
            $postData['publisher'],
            $postData['content'],
            new \DateTime($postData['at'])
        );
    }
}
