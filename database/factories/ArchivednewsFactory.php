<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Archivednews;
use Faker\Generator as Faker;

$factory->define(Archivednews::class, function (Faker $faker) {
    return [
        'category_id' => function() {
            return factory(\App\Models\Category::class)->create()->id;
        },
        'deletecriteria_id' => function() {
            return factory(\App\Models\Deletecriteria::class)->create()->id;
        },
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'event' => $faker->sentence,
        'location' => $faker->sentence,
        'note' => $faker->sentence,
    ];
});
