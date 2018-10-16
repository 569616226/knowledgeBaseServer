<?php

$factory->define(App\Containers\Question\Models\Question::class, function (Faker\Generator $faker) {

    $guest_ids = \App\Containers\Guest\Models\Guest::whereStatus(1)->get()->pluck('id')->toArray();
    $answer_ids = \App\Containers\Answer\Models\Answer::all()->pluck('id')->toArray();

    return [
        'guest_id'  => array_random($guest_ids),
        'answer_id' => array_random($answer_ids),
        'content'   => $faker->name,
    ];
});

