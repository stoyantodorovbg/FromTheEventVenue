<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Deletecriteria;
use Faker\Generator as Faker;

$factory->define(Deletecriteria::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
    ];
});
