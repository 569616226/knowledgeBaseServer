<?php


$factory->define(App\Containers\Order\Models\Order::class, function (Faker\Generator $faker) {

    $guest_ids = \App\Containers\Guest\Models\Guest::whereStatus(3)->get()->pluck('id')->toArray();

    return [
        'name'        => $faker->name,
        'guest_id'    => array_random($guest_ids),
        'order_no'    => create_order_number(),
        'answer_id'   => null,
        'appoint_id'  => null,
        'price'       => $faker->numberBetween(100, 200),
        'pay_type'    => 0,
        'status'      => $faker->numberBetween(0, 5),
        'answer_type' => $faker->numberBetween(0, 1),
        'pay_time'    => null,
        'cancel_res'  => '',
        'payee'       => '',
        'is_cancel'   => false,
    ];
});

