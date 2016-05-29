<?php
/**
 * @author Rizart Dokollari <***REMOVED***>
 * @since 5/29/16
 */
use App\Post;
use App\User;


function createPost($attributes = [])
{
    return factory(Post::class)->create($attributes);
}

function createUser($attributes = [])
{
    return factory(User::class)->create($attributes);
}
