<?php


$factory->define(App\Containers\Guest\Models\Guest::class, function (Faker\Generator $faker) {

    $open_id = $faker->unique()->name . uniqid();

    return [
        'open_id'        => $open_id,
        'name'           => $faker->name,
        'real_name'      => $faker->name,
        'password'       => \Illuminate\Support\Facades\Hash::make($open_id),
        'avatar'         => $faker->imageUrl(60, 60),
        'phone'          => 13413381448,
        'email'          => $faker->unique()->safeEmail,
        'we_name'        => $faker->name,
        'city'           => $faker->word,
        'single_profile' => $faker->word,
        'office'         => $faker->word,
        'cover'          => $faker->imageUrl(60, 60),
        'location'       => $faker->word,
        'card_id'        => $faker->creditCardNumber,
        'card_pic'       => $faker->imageUrl(60, 60),
        'referee'        => $faker->word,
        'remark'         => $faker->word,
        'profile'        => $faker->word,
        'status'         => $faker->numberBetween(0, 3),
        'gender'         => $faker->numberBetween(0, 2),
        'like_linkas'    => null,
        'viewed_linkas'  => null,
    ];
});

