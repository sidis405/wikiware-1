<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $name = ucfirst($faker->unique()->word),
        'slug' => str_slug(strtolower($name)),
    ];
});
