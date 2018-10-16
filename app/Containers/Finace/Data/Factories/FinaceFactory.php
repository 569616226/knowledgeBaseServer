<?php

$factory->define(App\Containers\Finace\Models\Finace::class, function (Faker\Generator $faker) {

    $guest_ids = \App\Containers\Guest\Models\Guest::whereStatus(3)->get()->pluck('id')->toArray();

    return [
        'name'       => $faker->name,
        'order_name' => $faker->name,
        'guest_id'   => array_random($guest_ids),
        'order_no'   => create_order_number(),
        'price'      => $faker->numberBetween(100, 200),
        'type'       => rand(0, 5),
    ];
});

