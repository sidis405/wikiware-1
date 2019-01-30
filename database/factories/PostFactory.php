<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $title = $faker->sentence,
        'slug' => str_slug($title),
        'preview' => $faker->sentences(3, true),
        'body' => $faker->paragraphs(5, true),

        'user_id' => factory(App\User::class),

        'category_id' => factory(App\Category::class),
    ];
});
