<?php

namespace App\Containers\Appoint\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class AppointRepository
 */
class AppointRepository extends Repository
{

    /**
     * The Container Name.
     * Must be set when the model has a different name than the container
     */
    protected $container = 'Appoint';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'         => '=',
        'case_id'    => '=',
        'status'     => '=',
        'cancel_res' => 'like',
        'canceler'   => 'like',
        'answers'    => 'like',
        'profile'    => 'like',
        'guest_id'   => '=',
        'topic_id'   => '=',
        // ...
    ];

}
