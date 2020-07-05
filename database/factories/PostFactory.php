<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
      'title' => $faker->realText( rand(12, 20)),
      'author_id' => rand(1,4),
      'descr' => $faker->realText(rand(100, 500)),
      'created_at' => $faker->dateTimeBetween('-30days', '-10days'),
      'updated_at' => $faker->dateTimeBetween('-30days', '-10days')
    ];
});
