<?php


$factory->define(App\Containers\AppointAppraise\Models\AppointAppraise::class, function (Faker\Generator $faker) {

    $guest_ids = \App\Containers\Guest\Models\Guest::whereStatus(3)->get()->pluck('id')->toArray();
    $appoint_ids = \App\Containers\Appoint\Models\Appoint::all()->pluck('id')->toArray();

    return [
        'star'       => $faker->numberBetween(1, 5),
        'degree'     => $faker->numberBetween(1, 5),
        'content'    => $faker->name,
        'guest_id'   => array_random($guest_ids),
        'appoint_id' => array_random($appoint_ids),
    ];
});

