<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Category;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $title = $faker->unique()->word;

    return [
        'title' => $title,
        'slug' => Str::slug($title, '-'),
    ];
});
