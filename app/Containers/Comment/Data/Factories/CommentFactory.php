<?php

$factory->define(\App\Containers\Comment\Models\Comment::class, function (Faker\Generator $faker) {

    $guestIds = App\Containers\Guest\Models\Guest::all()->pluck('id')->toArray();
    $articleIds = App\Containers\Article\Models\Article::all()->pluck('id')->toArray();

    return [
        'guest_id'   => array_random($guestIds),
        'article_id' => array_random($articleIds),
        'content'    => $faker->text,
    ];
});
