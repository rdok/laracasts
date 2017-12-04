<?php

namespace Tests\Feature;

use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_browse_threads()
    {
        $latestThread = factory(Thread::class)->create();

        $response = $this->get('/thread');

        $response->assertStatus(200);

        $content = $response->getContent();

        $this->assertContains($latestThread->title, $content);

        $this->assertContains($latestThread->body, $content);
    }
}
