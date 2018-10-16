<?php

use App\Containers\Article\Models\Article;

$factory->define(Article::class, function (Faker\Generator $faker) {

    $guestIds = App\Containers\Guest\Models\Guest::all()->pluck('id')->toArray();

    return [
        'guest_id' => array_random($guestIds),
        'title'    => $faker->word,
        'content'  => $faker->text,
        'cover'    => $faker->imageUrl(60, 60),
        'status'   => 2,
        'readers'  => 0,
        'like'     => [],
        'remark'   => $faker->word,
    ];
});
