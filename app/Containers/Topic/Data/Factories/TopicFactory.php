<?php


$factory->define(App\Containers\Topic\Models\Topic::class, function (Faker\Generator $faker) {

    $guest_ids = \App\Containers\Guest\Models\Guest::whereStatus(3)->get()->pluck('id')->toArray();

    return [
        'guest_id'   => array_random($guest_ids),
        'title'      => $faker->name,
        'describe'   => $faker->name,
        'price'      => $faker->numberBetween(100, 200),
        'status'     => $faker->numberBetween(0, 2),
        'ser_type'   => $faker->numberBetween(0, 1),
        'ser_time'   => $faker->randomNumber(),
        'need_infos' => null,
        'remark'     => null,
    ];
});

