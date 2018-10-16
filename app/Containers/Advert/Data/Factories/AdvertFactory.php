<?php

$factory->define(App\Containers\Advert\Models\Advert::class, function (Faker\Generator $faker) {
    $user_ids = \App\Containers\User\Models\User::all()->pluck('id')->toArray();
    return [
        'name'  => $faker->name,
        'path'  => $faker->imageUrl(),
        'type'  => '1',
        'order' => '1',
        'url'   => $faker->url,
        'user_id'   => array_random($user_ids),
    ];
});

