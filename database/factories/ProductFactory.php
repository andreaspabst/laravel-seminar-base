<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->text(20),
        'price' => $faker->randomFloat(2),
        'stock' => $faker->randomNumber()
    ];
});
