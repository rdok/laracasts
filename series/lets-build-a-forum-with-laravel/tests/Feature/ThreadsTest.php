<?php

namespace Tests\Feature;

use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_view_latest_thread_on_index()
    {
        $latestThread = factory(Thread::class)->create();

        $response = $this->get('/thread');

        $response->assertSee($latestThread->title);

        $response->assertSee($latestThread->body);
    }

    /** @test */
    public function a_user_can_view_a_single_thread()
    {
        $thread = factory(Thread::class)->create();

        $response = $this->get('/thread/' . $thread->id);

        $response->assertSee($thread->title);

        $response->assertSee($thread->body);
    }
}
