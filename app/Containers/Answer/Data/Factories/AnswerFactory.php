<?php


$factory->define(App\Containers\Answer\Models\Answer::class, function (Faker\Generator $faker) {

    return [
        'name'   => $faker->name,
        'price'  => $faker->numberBetween(100, 200),
        'status' => $faker->numberBetween(0, 2),
        'star'   => 0
    ];
});

