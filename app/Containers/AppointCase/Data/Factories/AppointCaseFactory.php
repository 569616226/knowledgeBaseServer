<?php


$factory->define(App\Containers\AppointCase\Models\AppointCase::class, function (Faker\Generator $faker) {

    $guest_ids = \App\Containers\Guest\Models\Guest::whereStatus(3)->get()->pluck('id')->toArray();
    $appoint_ids = \App\Containers\Appoint\Models\Appoint::all()->pluck('id')->toArray();

    return [
        'guest_id'     => array_random($guest_ids),
        'appoint_id'   => array_random($appoint_ids),
        'location'     => $faker->name,
        'appoint_time' => now(),
    ];
});

