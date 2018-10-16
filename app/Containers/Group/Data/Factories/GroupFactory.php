<?php


$factory->define(App\Containers\Group\Models\Group::class, function (Faker\Generator $faker) {

    $user_ids = \App\Containers\User\Models\User::all()->pluck('id')->toArray();

    return [
        'name'    => $faker->name,
        'user_id' => array_random($user_ids),
    ];
});

