<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\House;
use Faker\Generator as Faker;

// https://github.com/fzaninotto/Faker
$factory->define(House::class, function (Faker $faker) {
    return [
        'title' => $faker->words(5, true),
        'description' => $faker->words(5, true),
        'price' => $faker->numberBetween(100000,999999999)
    ];
});
