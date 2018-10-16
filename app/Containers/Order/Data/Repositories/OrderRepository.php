<?php

namespace App\Containers\Order\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class OrderRepository
 */
class OrderRepository extends Repository
{

    /**
     * The Container Name.
     * Must be set when the model has a different name than the container
     */
    protected $container = 'Order';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'         => '=',
        'name'       => 'like',
        'order_no'   => '=',
        'answer_id'  => '=',
        'appoint_id' => '=',
        'guest_id'   => '=',
        'price'      => '=',
        'pay_type'   => '=',
        'status'     => '=',
        'pay_time'   => '=',
        'cancel_res' => 'like',
        'payee'      => 'like',
    ];

}
