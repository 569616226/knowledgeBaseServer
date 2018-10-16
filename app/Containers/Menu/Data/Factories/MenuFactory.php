<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Containers\Menu\Models\Menu::class, function (Faker $faker) {
    return [
        'name'       => $faker->word,
        'icon'       => $faker->name,
        'url'        => 'permissions',
        'created_at' => now(),
        'updated_at' => now()->addDays(3),
    ];
});
