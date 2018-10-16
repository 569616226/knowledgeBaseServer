<?php


$factory->define(App\Containers\Nav\Models\Nav::class, function (Faker\Generator $faker) {

    $user_ids = \App\Containers\User\Models\User::all()->pluck('id')->toArray();

    return [
        'name'    => $faker->name,
        'icon'    => $faker->imageUrl(20, 20),
        'pid'     => 0,
        'user_id' => array_random($user_ids),
    ];
});

