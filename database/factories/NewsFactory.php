<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\News;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    return [
        'category_id' => factory(\App\Models\Category::class)->create()->id,
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'event' => $faker->sentence,
        'location' => $faker->sentence,
    ];
});
