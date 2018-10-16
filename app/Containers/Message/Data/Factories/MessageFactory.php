<?php

$factory->define(App\Containers\Message\Models\Message::class, function (Faker\Generator $faker) {

    return [
        'sender'     => $faker->name,
        'group_name' => $faker->name,
        'img_url' => $faker->imageUrl(),
        'title'      => $faker->word,
        'content'    => $faker->text,
        'msg_type'   => random_int(0, 2),
        'is_read'    => $faker->boolean,
    ];
});

