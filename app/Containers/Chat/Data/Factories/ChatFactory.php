<?php


$factory->define(App\Containers\Chat\Models\Chat::class, function (Faker\Generator $faker) {

    return [
        'content' => $faker->name,
        'pid'     => 0,
        'is_read' => 0,
    ];
});

