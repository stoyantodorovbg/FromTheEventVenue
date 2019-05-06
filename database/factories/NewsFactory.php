<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\News;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    $title = $faker->unique()->sentence;

    return [
        'category_id' => function() {
            return factory(\App\Models\Category::class)->create()->id;
        },
        'title' => $title,
        'slug' => Str::slug($title, '-'),
        'body' => $faker->paragraph(15),
        'event' => $faker->sentence,
        'location' => $faker->sentence,
    ];
});
