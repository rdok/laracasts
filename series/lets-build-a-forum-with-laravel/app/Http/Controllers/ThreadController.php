<?php

namespace App\Http\Controllers;

use App\Thread;

class ThreadController extends Controller
{
    public function index()
    {
        $threads = Thread::latest()->get();

        return view('thread.index', compact('threads'));
    }

    public function show(Thread $thread)
    {
        return view('thread.show', compact('thread'));
    }
}
