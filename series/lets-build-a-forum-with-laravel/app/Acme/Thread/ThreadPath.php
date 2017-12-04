<?php
/**
 * @author Rizart Dokollari <***REMOVED***>
 * @since 12/4/17
 */

namespace App\Acme\Thread;


use App\Thread;

trait ThreadPath
{
    public function path()
    {
        /** @var Thread $thread */
        $thread = $this;

        return '/thread/' . $thread->id;
    }
}