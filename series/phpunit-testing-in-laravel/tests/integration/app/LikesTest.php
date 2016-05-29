<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LikesTest extends TestCase
{
    use DatabaseTransactions;

    protected $post;

    public function setUp()
    {
        parent::setUp();

        $this->post = createPost();
        $this->user = createUser();
    }

    /** @test */
    public function a_user_can_like_a_post()
    {
        $this->dontSeeInDatabase('likes', [
            'user_id'       => $this->user->id,
            'likeable_id'   => $this->post->id,
            'likeable_type' => get_class($this->post),
        ]);

        $this->user->like($this->post);

        $this->seeInDatabase('likes', [
            'user_id'       => $this->user->id,
            'likeable_id'   => $this->post->id,
            'likeable_type' => get_class($this->post),
        ]);
    }

    /** @test */
    public function a_user_can_unlike_a_post()
    {
        $this->user->like($this->post);

        $this->seeInDatabase('likes', [
            'user_id'       => $this->user->id,
            'likeable_id'   => $this->post->id,
            'likeable_type' => get_class($this->post),
        ]);

        $this->user->unlike($this->post);

        $this->dontSeeInDatabase('likes', [
            'user_id'       => $this->user->id,
            'likeable_id'   => $this->post->id,
            'likeable_type' => get_class($this->post),
        ]);
    }

    /** @test */
    public function a_post_knows_how_many_likes_has()
    {
        $users = factory(User::class, 2)->create();

        $users->get(0)->like($this->post);
        $users->get(1)->like($this->post);

        $this->assertCount(2, $this->post->likes()->get());
    }
}
