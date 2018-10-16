<?php


$factory->define(App\Containers\Appoint\Models\Appoint::class, function (Faker\Generator $faker) {

    $guest_ids = \App\Containers\Guest\Models\Guest::whereStatus(3)->get()->pluck('id')->toArray();
    $topic_ids = \App\Containers\Topic\Models\Topic::all()->pluck('id')->toArray();

    return [
        'cancel_res' => $faker->name,
        'canceler'   => $faker->name,
        'answers'    => '[0,1,2]',
        'profile'    => $faker->name,
        'topic_id'   => array_random($topic_ids),
        'guest_id'   => array_random($guest_ids),
        'status'     => $faker->numberBetween(0, 6)
    ];

});

