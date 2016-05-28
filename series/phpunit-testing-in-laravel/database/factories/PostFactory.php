<?php

use App\Post;

$factory->define(Post::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});
