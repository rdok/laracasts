<?php

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LikesTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function a_user_can_like_a_post()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();

        $this->dontSeeInDatabase('likes', [
            'user_id'       => $user->id,
            'likeable_id'   => $post->id,
            'likeable_type' => get_class($post),
        ]);

        $user->like($post);

        $this->seeInDatabase('likes', [
            'user_id'       => $user->id,
            'likeable_id'   => $post->id,
            'likeable_type' => get_class($post),
        ]);
    }

    /** @test */
    public function a_user_can_unlike_a_post()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();

        $user->like($post);

        $this->seeInDatabase('likes', [
            'user_id'       => $user->id,
            'likeable_id'   => $post->id,
            'likeable_type' => get_class($post),
        ]);

        $user->unlike($post);

        $this->dontSeeInDatabase('likes', [
            'user_id'       => $user->id,
            'likeable_id'   => $post->id,
            'likeable_type' => get_class($post),
        ]);
    }

    /** @test */
    public function a_post_knows_how_many_likes_has()
    {
        $users = factory(User::class, 2)->create();
        $post = factory(Post::class)->create();

        $users->get(0)->like($post);
        $users->get(1)->like($post);

        $this->assertCount(2, $post->likes()->get());
    }
}
