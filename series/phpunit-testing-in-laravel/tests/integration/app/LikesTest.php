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

        $this->assertCount(0, $user->likedPosts()->get());

        $user->like($post);

        $this->assertCount(1, $user->likedPosts()->get());

//        $this->assertEquals($post, $user->likedPosts()->get()->get(0));

        $this->seeInDatabase('likes', [
            'user_id'       => $user->id,
            'likeable_id'   => $post->id,
            'likeable_type' => get_class($post),
        ]);
    }
}
